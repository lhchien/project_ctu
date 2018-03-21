<div id="googleMap" style="width: 100%; height: 500px;">Google Map</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
	var locations = [
	['Le bao trang, 0936 701 279, hocthuatcanban.com', 10.04441595395967,105.75593948364258,1],
	['def', 10.022948394510141,105.8477783203125,2]
	];

	var map = new google.maps.Map(document.getElementById('googleMap'),{
		zoom: 12,
		center: new google.maps.LatLng(10.022948394510141,105.8477783203125),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow();
	var marker, i;
	for(i=0; i<locations.length; i++){

		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			draggable:true,
	        animation: google.maps.Animation.DROP,
			map: map
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
          stylers: [
     
          ]
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

</script>