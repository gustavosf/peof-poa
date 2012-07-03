<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>Postos de Entrega de Oléo de Fritura em Porto Alegre</title>
		<link href="https://developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var latlng = new google.maps.LatLng(-30.02770410, -51.22873460),
					myOptions = {
						zoom: 12,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					},
					map = new google.maps.Map(document.getElementById("map_canvas"), myOptions),
					infoWindow = new google.maps.InfoWindow();

				$.get('peof.php', function(data) {
					$.each(data, function(i, el){
						var marker = new google.maps.Marker({
							map: map,
							position: new google.maps.LatLng(el.lat, el.lon),
							data: el,
							icon: 'oil-recycle.png',
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
			});
		</script>
	</head>
	<body><div id="map_canvas" style="height:100%"></div></body>
</html>
