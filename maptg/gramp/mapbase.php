<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map { height: 100% }
</style>
<title>mapthegraph!</title>
<script type="text/javascript"
src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script language="javascript">
var map;
var info;

function init() {
	
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 6,
			center: new google.maps.LatLng(54, 12);
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		});
 
		
		google.maps.addListener(map, "click", function(e) {
		
			var setstatushtml = document.createElement("form");
			var lng = e.latLng.lng();
			var lat = e.latLng.lat();
			setstatushtml.setAttribute("action","");
			setstatushtml.onsubmit = function () {/*function to submit data to server,also define axaj callback.callback-->will contain code for creating a marker,close the info window return false;*/};
			setstatushtml.innerHTML = '<?php // write code to set status and location according to user's fb id?>' + '<input type="submit" value="Update"/>'
			+ '<input type="hidden" id="longitude" value="' + lng + '"/>'
			+ '<input type="hidden" id="latitude" value="' + lat + '"/>';
			
			info = new google.maps.InfoWindow({
												  content:setstatushtml,
												  map:map
												  });
			
		});
	
}
function addMarker(latlng,html) {
	var marker = new google.maps.Marker({
										position: latlng,
										});
	var info2 = new google.maps.InfoWindow({content:html										  
												  }); 
	google.maps.addListener(marker,'click',function () {info2.open(map);});
	google.maps.addListener(marker,'mouseover',function () {info2.open(map);});
	marker.setMap(map);
}


</script>
</head>

<body onLoad="init()">


<div id="map" style="width:600px; height:400px"></div>
</body>
</html>