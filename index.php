
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Google Maps JavaScript API v3 Example: Geocoding Simple</title>
<link href="https://developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
	var geocoder;
	var map;
	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-30.02770410, -51.22873460);
		var myOptions = {
			zoom: 12,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		var infoWindow = new google.maps.InfoWindow();

		$.get('peof.php', function(data) {
			$.each(data, function(i, el){
				var marker = new google.maps.Marker({
					map: map,
					position: new google.maps.LatLng(el.lat, el.lon),
					data: el,
					icon: 'http://mapicons.nicolasmollet.com/wp-content/uploads/mapicons/shape-default/color-a64f0c/shapecolor-no/shadow-0/border-no/symbolstyle-color/symbolshadowstyle-white/gradient-no/recycle.png',
				});
				google.maps.event.addListener(marker, "click", function() {
					openInfoWindow(marker);
				});
			});
		}, 'json');

		function openInfoWindow(marker) {
			var content = '<b>'+marker.data.location+'</b><br>';
			content += '<i>'+marker.data.address+'</i><br><br>';
			content += 'Horário de Atendimento: '+marker.data.operation+'<br>';
			content += 'Telefone: '+marker.data.phone;
			infoWindow.setContent(content);
			infoWindow.open(map, marker);
		}
	}
</script>
</head>
<body onload="initialize()">
	<div id="map_canvas" style="height:100%"></div>
</body>
</html>
