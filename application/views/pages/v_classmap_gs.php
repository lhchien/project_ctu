<?php if(!$this->session->userdata('login')) redirect(); ?>
<style type="text/css">
#img-map{
    height: 90px;
}
#wrapPopupMap{
    height:100%;
    width:100%;
    text-align: justify;
}
#trai{
    float: left;
    padding-right: 5px;
}
#phai{
    float: right;
}
</style>

<div class="container">
<h2 class="text-lg"><span class="text-muted">Bản đồ thông tin </span> lớp đang dạy</h2>
<hr>
<?php
$where = array('gs_tk_id' => $this->session->userdata('login')->tk_id);
$gs = $this->m_giasu->getGiaSuInfo($where); //var_dump($gs);

$sql = "SELECT * FROM lopday l, dangky d WHERE ld_id=dk_ld_id AND dk_gs_id=".$this->session->userdata('login')->tk_id." AND dk_trangthai=1";
$q = $this->db->query($sql)->result(); //var_dump($q);
?>

<style type="text/css">
#map_canvas { 
	width: 100%;
	height: 500px;
}
</style>

<div class="container text-center">
	<form class="form-inline">
		<div class="form-group">
			<label for="start">Từ nơi: </label>
			<input type="text" name="start" id="start" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="end">Đến nơi: </label>
			<input type="text" name="end" id="end" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="distance">Khoảng cách (km): </label>
			<input type="text" name="distance" id="distance" readonly="true" disabled class="form-control"/>
		</div>
		
		<input type="button" value="Khoảng cách & Đường đi" id="btn" class="btn btn-primary" />
        <input type="button" value="Reset" id="btnReset" class="btn btn-primary" />
		
		<input id="pac-input" class="controls" type="text" placeholder="Nhập địa điểm cần tìm" style="width: 300px; height: 30px;">

	</form>
	<br/>

	<div id="map_canvas" style="background-color: lightblue;" > bando</div>
</div>

</div>


<script type="text/javascript">
jQuery(document).ready(function($){
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
		alert(start+end);
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
                	echo "['".$mota."', ".$row->ld_diadiem.",'./img/iconclassmap.png'],"; }  ?> ['Vị trí hiện tại của bạn',<?php echo $gs->gs_diadiem; ?>,'./img/iconusermap.png'] 
                ];

    var map = new google.maps.Map(document.getElementById('map_canvas'),{
                zoom: 12,
                center: new google.maps.LatLng(<?php echo $gs->gs_diadiem; ?>),
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

                    alert("Lat=" + lat + "; Lng=" + lng);
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

    /*search box google map*/
	var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
	map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
	google.maps.event.addListener(searchBox, 'places_changed', function() {
	 searchBox.set('map', null);
	 	var image = './img/iconmap.png';
		var places = searchBox.getPlaces();
		var bounds = new google.maps.LatLngBounds();
		var i, place;
		for (i = 0; place = places[i]; i++) {
			(function(place) {
			 var marker = new google.maps.Marker({
			   position: place.geometry.location,
			   icon: image
			 });
			 marker.bindTo('map', searchBox, 'map');

			//show thong tin khi click vao marker
			marker.addListener('click', function() {
	          	infowindow.setContent(place.name+"<br/>"+place.formatted_address);
             	infowindow.open(map, marker);
	        });
			 
			 google.maps.event.addListener(marker, 'map_changed', function() {
			   if (!this.getMap()) {
			     this.unbindAll();
			   }
			 });
			 bounds.extend(place.geometry.location);

			}(place));

		}// end for
		map.fitBounds(bounds);
		searchBox.set('map', map);
		map.setZoom(Math.min(map.getZoom(),12));

	});/*end search box google map*/

}); //end window onload
</script>