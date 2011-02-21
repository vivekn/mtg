<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
	<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" media="screen"/>
	<title>mapTheGraph!</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA="screen">
	</script>
	<script type="text/javascript"
		src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js">
	</script>
	<script type="text/javascript" src = "jquery.timeago.js"></script>
	<!-- jQuery Code starts here-->
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajaxSetup({
						cache:false
						});
		
			$('#apDiv1').load('miniprof.php',"uid=<?=$uid?>");
			$("#ShowHelp").show();
			<?php
			/*Handle pending requests*/
			foreach ($friend_req_array as $sth) {
				echo "jQuery('<div id = \"freq_d$sth\" title = \"Accept Friend request\">').appendTo(\"body\");"; 
				echo "jQuery('#freq_d$sth').dialog({autoOpen:false,modal:true}).load('frequest.php','uid=$sth&me=$uid');";
				echo "jQuery('#freq_d$sth').dialog('open');";
			}
			?>
			$('#frnd_upd').load('ffeed.php',"uid=<?=$uid?>&start=0");
		
			});
	</script>
	<!-- jQuery Code ends here,Map code begins-->
	
	<script type="text/javascript"
		src="http://www.google.com/jsapi"></script>
	 
	<script type="text/javascript">
	
	// Loading the Google Maps API
		google.load('maps', 3, {
			'other_params': 'sensor=false&language=en'
		});
	  
		var map, geocoder, info, smode=false, markersArray=[], k=0, infoArray=[], markers=[];
		
		function addMarker(location) {
			marker = new google.maps.Marker({
				position: location,
				map: map,
			});
			markersArray.push(marker);
		}

	// Deletes all markers in the array by removing references to them
		function deleteOverlays() {
			if (markersArray) {
				for (i in markersArray) 
					markersArray[i].setMap(null);
				markersArray.length = 0;
			}
		}
	
		function initialize() {
			// Getting the position of the user thru auto-geolocation
			if (google.loader.ClientLocation) {
				var latLng = new google.maps.LatLng(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude);
				var zoom = 11;  		
				}
		  		
			else {
				var latLng = new google.maps.LatLng(0, 0);
				var zoom = 1;
		  		
				if (!geocoder) 
					geocoder = new google.maps.Geocoder();
			}
			
			var myOptions = {
				zoom: zoom,
				center: latLng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				zoomControl: true,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE
				}
			};
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
			// Get location from facebook
			var geocoderRequest = {
				address: '<?php if (isset($fbme['location'])) {echo $fbme['location']['name'];}?>',
			};
		  
			geocoder.geocode(geocoderRequest, function(results, status) {
			// Check to see if the request went allright
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0].geometry && zoom < 11) 
						map.setOptions({center: results[0].geometry.location, zoom: 10});		 	
				}
			});
					
			google.maps.event.addListener(map,'dblclick',function (event) 	 {
				deleteOverlays();
				addMarker(event.latLng);
				var html = document.createElement("div");
				
				var btn = document.createElement("div");
				btn.setAttribute('class','buttonwrapper');
				
				var span = document.createElement("a");
				span.setAttribute('id','status_upd');
				span.onclick =   function () {
					addMarker2(event.latLng);
					var msg = $("#st_text").val();
					var tag = $("input[name='group']:checked").val();
					var loc = getAddress(event.latLng);
					$.post('./setstatus.php',{ //check jQuery docs for this
						uid:<?=$uid?>,
						msg:msg,
						lat:event.latLng.lat(),
						lng:event.latLng.lng(),
						tag:tag,
						loc:loc, 
					});
					info.close();
					now = new Date;
					sendtime = now.getMilliseconds() + now.getSeconds *1000;
					$('#apDiv1').load('miniprof.php',"uid=<?=$uid?>&time="+sendtime);
				}
				span.setAttribute('class','boldbuttons');
				span.setAttribute('href','#');
				span.innerHTML = '<span>Set Location</span>';
				btn.appendChild(span);
				html.innerHTML = '<textarea name="st_text" id="st_text"  ></textarea><br>Pick a Tag: <input type="radio" name="group" value="" checked></input><img class="tag_img" src="globe.png" width="32" height="32" title="Nothing in particular"></img> <input type="radio" name="group" value="home"></input> <img class="tag_img" src="home48.png" width="32" height="32" title="home"></img> <input type="radio" name="group" value="restaurant"></input> <img class="tag_img" src="dine.jpg" width="32" height="32" title="restaurant"></img> <input type="radio" name="group" value="workplace"></input> <img class="tag_img" src="workplace.gif" width="32" height="32" title="workplace"></img><input type="radio" name="group" value="college/school"></input><img class="tag_img" src="school-icon.png" width="32" height="32" title = "college/school"></img><br>';
				html.appendChild(btn);
				addInfo(event.latLng,html);
			});					
		}
	
		function addMarker2(latlng) {
			
			var marker = new google.maps.Marker({
											position:latlng,
												});
			marker.setMap(map);
		}
	
		function addMarkerInfo(latlng,html) {
				
				markers.push(new google.maps.Marker({
												position:latlng,
												}));
				ind = markers.length - 1;
				contents = "<div onload=\"$('abbr.timeago').timeago()\">"+html+"</div>";
				if(!info)
					info = new google.maps.InfoWindow();
				google.maps.event.addListener(markers[ind], 'mouseover', function () {
					info.setContent(contents);
					info.open(map, markers[ind]);
				});
				markers[ind].setMap(map);		
				$("abbr.timeago").timeago();
		}
	
	
		function addInfo(latlng,html) {
			if(!info) 
				info = new google.maps.InfoWindow();			
			info.setContent(html);
			info.open(map,markersArray[0]);
		}
	
		//Reverse Geocoding function
		function getAddress(latLng) {
		// Check to see if a geocoder object already exists
			if (!geocoder) 
				geocoder = new google.maps.Geocoder();
		// Creating a GeocoderRequest object
			var geocoderRequest = {
				latLng: latLng,
			};	  
			geocoder.geocode(geocoderRequest, function(results, status) {
				// Check to see if the request went allright
				if (status == google.maps.GeocoderStatus.OK) {
					if (results[0].formatted_address) 
							return results[0].formatted_address;
				}
				else 
					return "";
			});
		  		
		}
	</script>
</head>
<body onLoad="initialize()">
	<a id="msgdown" ></a>
	<div id="apDiv1" class="design"></div>
	<div id="apDiv2" class="design2">Double click on the map to update your location</div>
	<div id = "frnd_upd" class="design"></div>
	<div id ="freq_d" title="Accept Request"></div>
	<div id="map_canvas"></div>
	<div id ="fsug_d" title="Add friends" style="display:none"><img src="ajax-loader.gif" alt="Loading ..."  /></div>
</body>
</html>