<?php
class A_thisposition extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
         
    function submit() {
        $lat = isset($_GET['lat']) ? $_GET['lat'] : 0; 
		$lon = isset($_GET['lon']) ? $_GET['lon'] : 0; 
		$slmon = isset($_GET['slmon']) ? $_GET['slmon'] : NULL;
        $sllop = isset($_GET['sllop']) ? $_GET['sllop'] : NULL;
        $slnamkn = isset($_GET['slnamkn']) ? $_GET['slnamkn'] : NULL;
        $tinh = isset($_GET['tinh']) ? $_GET['tinh'] : NULL;
        $sql="SELECT DISTINCT
                 `gs_tk_id`, `gs_hoten`, `gs_gioitinh`, `gs_namsinh`, `gs_dienthoai`, `gs_diadiem`, `gs_motadiadiem`, `gs_hinhanh`, `gs_gioithieu`, `gs_trinhdo`, `gs_chuyennganh`, `gs_congviec`, `gs_ngayday`, `gs_gioday`, `gs_kinhnghiem`, `gs_diachi`, `gs_trangthai`, `dl_mon`, `dl_lop`, `dl_gs_id` 
                 FROM giasu a, daylop b 
                 WHERE a.gs_tk_id=b.dl_gs_id AND gs_trangthai=1";
		if($slmon!=""){  
            $sql .= " AND dl_mon like '".$slmon."'";
    	} 
        if($slnamkn!=""){
            $sql .= " AND gs_kinhnghiem = '".$slnamkn."'";
        }
        if($sllop!=""){
            $sql .= " AND dl_lop like '".$sllop."'";
        }
        if($tinh!="")
            $sql .= " AND gs_diachi like '%".$tinh."'";

        $q1=$this->db->query($sql)->result();

    ?>

<div class="chitiet">
    <table id="tablechitiet" class="table table-striped table-hover table-bordered tableData">
        <thead>
        <tr>
            <th colspan="2" class="text-center">Gia sư <?php echo $slmon; //echo $sql;?> gần bạn <?php //echo $sql; ?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></th>
        </tr>
        </thead>
        <tr>
            <td>
                <!-- <marquee behavior="alternate">
                <b class="text-danger">Hướng dẫn:</b>
                <i class="text-primary">Click vào marker để xem thông tin gia sư <?php echo $lat."-".$lon;  ?></i>
                </marquee> -->
                <?php 
                foreach ($q1 as $row){ 
                    $mon = "<b>Dạy môn: </b>"; 
                    $s2="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$row->gs_tk_id ORDER BY dl_mon"; 
                    $dm = $this->db->query($s2)->result(); 
                    foreach ($dm as $dm) { 
                        $lop = "";
                        $mon .="- ".$dm->dl_mon." (";

                        $s1="SELECT DISTINCT dl_lop FROM daylop WHERE dl_gs_id=$row->gs_tk_id AND dl_mon like '".$dm->dl_mon."' ORDER BY dl_lop"; 
                        $dl = $this->db->query($s1)->result(); 
                        foreach ($dl as $dl) { 
                            $lop .="- ".$dl->dl_lop;
                        } 
                        $lop .= ")<br/>";
                        $mon .= $lop;
                    } 
                    //echo $mon; 
                }
                ?>
                <center>
                
                <form class="form-inline">
                    <?php empty($slmon) ? Mylibrary::showMonNonMulti() : Mylibrary::showMonNonMulti($slmon); ?>
                    <select data-placeholder="Chọn lớp học..." class="form-control" name="slLop" id="slLop" style="width: 150px;">
                        <option value="">Chọn lớp</option>
                        <?php
                        for($i=1; $i<=12; $i++){ ?>
                            <option value="<?php echo 'Lớp '.$i; ?>" <?php if($sllop=="Lớp $i") echo "selected";?>><?php echo 'Lớp '.$i; ?></option>
                            <?php
                        } ?>
                        <option value='Luyện thi đại học' <?php if($sllop=='Luyện thi đại học') echo "selected";?>>Luyện thi đại học</option>
                        <option value='Luyện thi HS giỏi' <?php if($sllop=='Luyện thi HS giỏi') echo "selected";?>>Luyện thi HS giỏi</option>
                    </select>
                    <select name='slNamKN' id="slNamKN" class='form-control form-hg' style="width: 150px;">
                        <option value="">Chọn năm KN</option>
                        <option value="0">Chưa có KN</option>
                        <?php
                        for($i=1; $i<=20; $i++){ ?>
                            <option value="<?php echo $i; ?>" <?php if($slnamkn==$i) echo "selected";?>><?php echo $i.' năm'; ?></option>
                            <?php
                        } ?>
                    </select>
                    
                    <!-- <input type="button" value="Tìm" id="filterGS" class="btn btn-primary" /> -->
                </form><br/>

                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" id="element_3" name="lat" placeholder="R_Click điểm bắt đầu..." maxlength="100" value="" readonly="true" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" id="element_4" name="lng" placeholder="R_Click điểm đến..." maxlength="100" value="" readonly="true" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="distance" id="distance" readonly="true" disabled class="form-control" style="width: 100px;" />
                    </div>
                    <input type="button" value="Khoảng cách & Đường đi" id="btn" class="btn btn-primary" />
                    <input type="button" value="Reset" id="btnReset" class="btn btn-primary" />
                </form>
                </center>
            </td>
        </tr>
        <tr>
            <td><div id="map1" style="height: 380px;"></div></td>
        </tr>
        <tr>
            <td colspan="5" align="center">
                <input type="button" value=" Đóng " name="close" class="btn btn-xs btn-info btnclose" />
            </td>
        </tr>
    </table>   
</div>

<script type="text/javascript">

$(document).ready(function(){
    $( "#slMon, #slNamKN" ).removeClass( "form-hg" );

    $("#slMon, #slNamKN, #slLop").change(function(){
        var slmon = document.getElementById("slMon");
        var slnamkn = document.getElementById("slNamKN");
        var sllop = document.getElementById("slLop");
        //alert("<?php //echo $tinh; ?>");
        $.ajax({
            url : "<?php echo base_url('a_thisposition/submit'); ?>",
            type : "get",
            dateType:"text",
            data : {
                lat : <?php echo $lat; ?>,
                lon : <?php echo $lon; ?>,
                slmon: slmon.value,
                sllop: sllop.value,
                tinh: "<?php echo $tinh; ?>",
                slnamkn: slnamkn.value
            },
            success : function (result){
                //alert(result);
                $('#ketqua').html(result);
            }
        });
        $('#ketqua').show('slow'); 
    });
});
</script>

<script type="text/javascript" charset="utf-8" async defer>     
    $(document).ready(function() {
      	   
            var locations = [
                <?php foreach ($q1 as $row){ $mon = "<b>Dạy môn: </b>"; $s2="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$row->gs_tk_id ORDER BY dl_mon"; $dm = $this->db->query($s2)->result(); foreach ($dm as $dm) { $lop = ""; $mon .="- ".$dm->dl_mon." ("; $s1="SELECT DISTINCT dl_lop FROM daylop WHERE dl_gs_id=$row->gs_tk_id AND dl_mon like '".$dm->dl_mon."' ORDER BY dl_lop"; $dl = $this->db->query($s1)->result(); foreach ($dl as $dl) { $lop .="- ".$dl->dl_lop; } $lop .= ")<br/>"; $mon .= $lop;} $mota = "<div id=wrapPopupMap>"; $mota.= "<div id=trai><img src=./".$row->gs_hinhanh." id=img-map></div>"; $mota.= "<div id=phai>"; $mota.= "<b>Họ tên/Năm sinh: </b>".$row->gs_hoten."-".$row->gs_namsinh."<br/>"; $mota.= "<b>Điện thoại: </b>".$row->gs_dienthoai."<br/>"; $mota.= "<b>Trình độ: </b>".$row->gs_trinhdo."<br/>"; $mota.= $mon; $mota.= "<b>Mô tả địa điểm: </b>".$row->gs_motadiadiem."<br/>"; $mota.= "<b>Kinh nghiệm: </b>".$row->gs_kinhnghiem." năm <br/>"; $mota.= "</div>"; $mota.= "</div>"; echo "['".$mota."', ".$row->gs_diadiem.",'".Mylibrary::getIconImg($row->dl_mon)."'],"; }  ?> ['Vị trí hiện tại của bạn',<?php echo $lat ?>,<?php echo $lon?>,'./img/iconusermap.png'] 
                ];

            var map = new google.maps.Map(document.getElementById('map1'),{
                zoom: 12,
                center: new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $lon; ?>),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;	
            for(i=0; i<locations.length; i++){

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    icon:locations[i][3],
                    draggable:true,
                    animation: google.maps.Animation.DROP,
                    map: map
                }); //end marker

                marker.addListener("rightclick", function(event) {
                    var lat = event.latLng.lat();
                    var lng = event.latLng.lng();

                    //alert("Lat=" + lat + "; Lng=" + lng);
                    var str = lat+","+lng;
                    if($('#element_3').val()!='')
                        $('#element_4').val(str);
                    else
                        $('#element_3').val(str);
                

                }); 

                google.maps.event.addListener(marker,'click',(function(marker,i){
                    return function(){
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map,marker);
                        if (marker.getAnimation() !== null) {
                            marker.setAnimation(null);
                        } 
                        // else {
                        //     marker.setAnimation(google.maps.Animation.BOUNCE);
                        // }
                    }
                })(marker,i));

            }//end for


            var styles = [
                {
                  featureType: 'road.arterial',
                  elementType: 'all',
                  stylers: [
                    { hue: '#fff' },
                    { saturation: 100 },
                    { lightness: -48 },
                    { visibility: 'on' }
                  ]
                },
                {
                  featureType: 'road',
                  elementType: 'all',
                  stylers: []
                },
                {
                    featureType: 'water',
                    elementType: 'geometry.fill',
                    stylers: [
                        { color: '#adc9b8' }
                    ]
                },
                {
                    featureType: 'landscape.natural',
                    elementType: 'all',
                    stylers: [
                        { hue: '#809f80' },
                        { lightness: -35 }
                    ]
                }
            ];
             
            var styledMapType = new google.maps.StyledMapType(styles);
            map.mapTypes.set('Styled', styledMapType);

        //dong table dang nhap
        $('.close, .btnclose').click(function() {
            $('#ketqua').hide('slow');
            setTimeout(function(){window.location.href='<?php echo base_url(); ?>v_home'},1000)
            $( "#slMon, #slNamKN" ).addClass( "form-hg" );
            //$('#slTinh').removeAttr('disabled');
        });

        /* chi duong va tinh khoang cach */
        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
        $("#btn").click(function(){
            var start = document.getElementById("element_3").value;
            var end = document.getElementById("element_4").value;
            //alert(start+end);
            directionsDisplay.setMap(map);
            var distanceInput = document.getElementById("distance");
            
            var request = {
                origin:start, 
                destination:end,
                travelMode: google.maps.DirectionsTravelMode.DRIVING
            };
            
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    distanceInput.value = response.routes[0].legs[0].distance.value / 1000+" km";
                }
            });
        });

        $("#btnReset").click(function(){
            document.getElementById("element_3").value = '';
            document.getElementById("element_4").value = '';
            document.getElementById("distance").value = '';      
            if (directionsDisplay != null) {
                directionsDisplay.setMap(null);
                directionsDisplay = null;
            }
            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();
        }); 
        /* end chi duong va tinh khoang cach */


        /*search box google map*/
        // var infowindow = new google.maps.InfoWindow();
        // var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
        // map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
        // google.maps.event.addListener(searchBox, 'places_changed', function() {
        //  searchBox.set('map', null);
        //     var image = './img/iconmap.png';
        //     var places = searchBox.getPlaces();
        //     var bounds = new google.maps.LatLngBounds();
        //     var i, place;
        //     for (i = 0; place = places[i]; i++) {
        //         (function(place) {
        //          var marker = new google.maps.Marker({
        //            position: place.geometry.location,
        //            icon: image
        //          });
        //          marker.bindTo('map', searchBox, 'map');

        //         //show thong tin khi click vao marker
        //         marker.addListener('click', function() {
        //             infowindow.setContent(place.name+"<br/>"+place.formatted_address);
        //             infowindow.open(map, marker);
        //         });
                 
        //          google.maps.event.addListener(marker, 'map_changed', function() {
        //            if (!this.getMap()) {
        //              this.unbindAll();
        //            }
        //          });
        //          bounds.extend(place.geometry.location);

        //         }(place));

        //     }// end for
        //     map.fitBounds(bounds);
        //     searchBox.set('map', map);
        //     map.setZoom(Math.min(map.getZoom(),12));

        // });/*end search box google map*/
		
    }); //end jquery

</script>

<?php
	}
} 
?>  


