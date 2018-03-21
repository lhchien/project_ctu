<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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

	google.maps.event.addListener(map, "click", function(event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        //alert("Lat=" + lat + "; Lng=" + lng);
        $('#element_3').val(lat);
        //$("#element_3").attr("disabled", "disabled");    

        $('#element_4').val(lng);
        //$("#element_4").attr("disabled", "disabled");    

        var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(lat, lng),
	      map: map,
	      title: 'Right Click to delete'
    	});      

      
	    /*map.addListener('center_changed', function() {
	      // 3 seconds after the center of the map has changed, pan back to the
	      // marker.
	      window.setTimeout(function() {
	        map.panTo(marker.getPosition());
	      }, 3000);
	    });*/
	    marker.addListener("rightclick", function() {
    		marker.setMap(null);
		});
	    marker.addListener('click', function() {
	        //map.setCenter(marker.getPosition());
	        alert(this.position);
	        //$('#element_3').val(this.position);
	    });

	    
	});
	
 //google.maps.event.addDomListener(window, 'load');
  

}); //end window onload

    
</script>

<style type="text/css">
	#map_canvas { 
		width: 100%;
		height: 500px;
	}
</style>


<div class="container text-center">
	<form class="form-inline">
		<div class="form-group">
			<label for="start">Từ địa điểm: </label>
			<input type="text" name="start" id="start" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="end">Đến địa điểm: </label>
			<input type="text" name="end" id="end" class="form-control"/>
		</div>
		<div class="form-group">
			<label for="distance">Khoảng cách (km): </label>
			<input type="text" name="distance" id="distance" readonly="true" disabled class="form-control"/>
		</div>
		
		<input type="button" value="Khoảng cách & Đường đi" id="btn" class="btn btn-primary" />
		
		<input id="pac-input" class="controls" type="text" placeholder="Nhập địa điểm cần tìm" style="width: 300px; height: 30px;">

	</form>
	<br/>
	<!--<p>
		<label for="start">Từ địa điểm: </label>
		<input type="text" name="start" id="start" />
		
		<label for="end">Đến địa điểm: </label>
		<input type="text" name="end" id="end" />

		<label for="distance">Khoảng cách (km): </label>
		<input type="text" name="distance" id="distance" readonly="true" disabled />

		<input type="button" value="Khoảng cách & Chỉ đường" id="btn" />
	</p>-->

	<div id="map_canvas" style="background-color: lightblue;" > bando</div>
</div>





