<?php
class A_thisposition_ph extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
         
    function submit() {
        $lat = isset($_GET['lat']) ? $_GET['lat'] : 0; 
		$lon = isset($_GET['lon']) ? $_GET['lon'] : 0; 
        $slmon = isset($_GET['slmon']) ? $_GET['slmon'] : NULL;
        $sllop = isset($_GET['sllop']) ? $_GET['sllop'] : NULL;
        $sql = "SELECT DISTINCT ld_id, `ld_tieude`, `ld_mon`, `ld_khoilop`, `ld_soluong`, `ld_yeucau`, `ld_buoiday`, `ld_thoigian`, `ld_diadiem`, `ld_mota_diadiem`, `ld_hinhanh`, `ld_trangthai`, `ld_diem_cmt`, `ld_noidung_cmt`, dk_trangthai FROM lopday LEFT JOIN dangky ON lopday.ld_id = dangky.dk_ld_id WHERE (dk_trangthai = 0 OR dk_trangthai is NULL) AND lopday.ld_trangthai = 1 ";

        // if(!empty($slmon)){  
        //     $sql .= " AND l.dl_mon like '".$slmon."'";
        // } 
        if($slmon!=""){
            $sql .= " AND lopday.ld_mon like '".$slmon."'";
        }
        if($sllop!=""){
            $sql .= " AND lopday.ld_khoilop like '".$sllop."'";
        }

        $q=$this->db->query($sql)->result();
        $toado = $lat.",".$lon;

    ?>

<div class="chitiet">
    <table id="tablechitiet" class="table table-striped table-hover table-bordered tableData">
        <thead>
        <tr>
            <th colspan="2" class="text-center">Lớp <?php echo $slmon; //var_dump($sllop!="");?> gần bạn <?php //echo $sql; ?><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></th>
        </tr>
        </thead>
        <tr>
            <td>
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
                    
                    <!-- <input type="button" value="Tìm" id="filterGS" class="btn btn-primary" /> -->
                </form><br/>

                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" id="start" name="lat" placeholder="R_Click điểm bắt đầu..." maxlength="100" value="" readonly="true" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input type="text" id="end" name="lng" placeholder="R_Click điểm đến..." maxlength="100" value="" readonly="true" class="form-control"/>
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
            <td><div id="map_canvas" style="height: 380px;"></div></td>
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
    $( "#slMon" ).removeClass( "form-hg" );

    $("#slLop, #slMon").change(function(){
        var slmon = document.getElementById("slMon");
        var sllop = document.getElementById("slLop");
        //alert(sllop.value);
        $.ajax({
            url : "<?php echo base_url('a_thisposition_ph/submit'); ?>",
            type : "get",
            dateType:"text",
            data : {
                lat : <?php echo $lat; ?>,
                lon : <?php echo $lon; ?>,
                slmon: slmon.value,
                sllop: sllop.value
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

<script type="text/javascript">
 $(document).ready(function() {

    //dong table dang nhap
        $('.close, .btnclose').click(function() {
            $('.chitiet').hide('slow');
            $('#ketqua').hide('slow');
            //$('#slTinh').removeAttr('disabled');
        });

           
    var directionDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    var infowindow = new google.maps.InfoWindow();

    directionsDisplay = new google.maps.DirectionsRenderer();
    var melbourne = new google.maps.LatLng(10.044602, 105.748086);
    var myOptions = {
        zoom:12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: melbourne
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);

    


    $("#btn").click(function(){
        var start = document.getElementById("start").value;
        var end = document.getElementById("end").value;
        //alert(start+end);
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
    
    var locations = [
                <?php 
                foreach ($q as $row){ 
                    $mota = "<div id=wrapPopupMap>";
                    $mota.= "<div id=trai><img src=./".$row->ld_hinhanh." id=img-map></div>";
                    $mota.= "<div id=phai>";
                    //$mota.= "<b>Họ tên: </b>".$row->gs_hoten."-".$row->gs_namsinh."<br/>";
                     $mota.= "<b>Tiêu đề: </b>".$row->ld_tieude."<br/>";
                    $mota.= "<b>Dạy môn: </b>".$row->ld_mon."<br/>";
                    $mota.= "<b>Dạy lớp: </b>".$row->ld_khoilop."<br/>";
                    $mota.= "<b>Số lượng: </b>".$row->ld_soluong."<br/>";
                    $mota.= "<b>Dạy thứ: </b>".implode(", ",explode(",", $row->ld_buoiday))."<br/>";
                    $mota.= "<b>Thời gian: </b>".$row->ld_thoigian."<br/>";
                    //$mota.= "<b>Điện thoại: </b>".$row->gs_dienthoai."<br/>";
                    //$mota.= "<b>Mô tả địa điểm: </b>".$row->gs_motadiadiem."<br/>";
                    $mota.= "</div>";
                    $mota.= "</div>"; 
                    echo "['".$mota."', ".$row->ld_diadiem.",'./img/iconclassmap.png'],"; }  ?> ['Vị trí hiện tại của bạn',<?php echo $toado; ?>,'./img/iconusermap.png'] 
                ];

    var map = new google.maps.Map(document.getElementById('map_canvas'),{
                zoom: 12,
                center: new google.maps.LatLng(<?php echo $toado; ?>),
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
                    if($('#start').val()!='')
                        $('#end').val(str);
                    else
                        $('#start').val(str);
                
                }); 

                google.maps.event.addListener(marker,'click',(function(marker,i){
                    return function(){
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map,marker);
                        if (marker.getAnimation() !== null) {
                            marker.setAnimation(null);
                        } else {
                            marker.setAnimation(google.maps.Animation.BOUNCE);
                        }
                    }
                })(marker,i));

            }//end for


    /* chi duong va tinh khoang cach */
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();
    $("#btn").click(function(){
        var start = document.getElementById("start").value;
        var end = document.getElementById("end").value;
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
        document.getElementById("start").value = '';
        document.getElementById("end").value = '';
        document.getElementById("distance").value = '';      
        if (directionsDisplay != null) {
            directionsDisplay.setMap(null);
            directionsDisplay = null;
        }
        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
    }); 
    /* end chi duong va tinh khoang cach */

   
        
}); //end jquery
</script>

<?php
	}
} 
?>  


