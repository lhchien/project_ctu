<?php
class A_thisposition1 extends CI_Controller {
    function __construct(){
        parent::__construct();
    }
         
    function submit() {
		$slmon = isset($_GET['slmon']) ? $_GET['slmon'] : NULL;
        $sllop = isset($_GET['sllop']) ? $_GET['sllop'] : NULL;
        $sltinh = isset($_GET['sltinh']) ? $_GET['sltinh'] : NULL;
        $slnamkn = isset($_GET['slnamkn']) ? $_GET['slnamkn'] : NULL;
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
        if($sltinh!=""){
            $where    = array( "ID_TINH" => $sltinh);
            $this->db->where($where);
            $result   = $this->db->get('tinh')->row(); //var_dump($result);
            $toado    = $result->GHICHU;
            $tentinh   = $result->TENTINH;
            $sql .= " AND gs_diachi like '%".$tentinh."'";
        }
        else
            $toado    ="10.0345442,105.7214788"; //echo $toado;
        $q1=$this->db->query($sql)->result();
        //echo $sql; die();
    ?>
<div id="map" style="height: 380px;"></div>


<script type="text/javascript" charset="utf-8" async defer>     
    $(document).ready(function() {
      	   
            var locations = [
                <?php foreach ($q1 as $row){ $mon = "<b>Dạy môn: </b>"; $s2="SELECT DISTINCT dl_mon FROM daylop WHERE dl_gs_id=$row->gs_tk_id ORDER BY dl_mon"; $dm = $this->db->query($s2)->result(); foreach ($dm as $dm) { $lop = ""; $mon .="- ".$dm->dl_mon." ("; $s1="SELECT DISTINCT dl_lop FROM daylop WHERE dl_gs_id=$row->gs_tk_id AND dl_mon like '".$dm->dl_mon."' ORDER BY dl_lop"; $dl = $this->db->query($s1)->result(); foreach ($dl as $dl) { $lop .="- ".$dl->dl_lop; } $lop .= ")<br/>"; $mon .= $lop;} $mota = "<div id=wrapPopupMap>"; $mota.= "<div id=trai><img src=./".$row->gs_hinhanh." id=img-map></div>"; $mota.= "<div id=phai>"; $mota.= "<b>Họ tên/Năm sinh: </b>".$row->gs_hoten."-".$row->gs_namsinh."<br/>"; $mota.= "<b>Điện thoại: </b>".$row->gs_dienthoai."<br/>"; $mota.= "<b>Trình độ: </b>".$row->gs_trinhdo."<br/>"; $mota.= $mon; $mota.= "<b>Mô tả địa điểm: </b>".$row->gs_motadiadiem."<br/>"; $mota.= "<b>Kinh nghiệm: </b>".$row->gs_kinhnghiem." năm <br/>"; $mota.= "</div>"; $mota.= "</div>"; echo "['".$mota."', ".$row->gs_diadiem.",'".Mylibrary::getIconImg($row->dl_mon)."'],"; }  ?>
                ];

            var map = new google.maps.Map(document.getElementById('map'),{
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
		
    }); //end jquery

</script>

<?php
	}
} 
?>  


