<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" media="screen"/>

<title>mapTheGraph!</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="ui/jquery.ui.dialog.js"></script>
<script src="ui/jquery.ui.mouse.js"></script>
<script src="ui/jquery.ui.draggable.js"></script>
<script src="ui/jquery.ui.position.js"></script>
<script src="ui/jquery.ui.resizable.js"></script>

<LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA="screen">

</script>
<script type="text/javascript"
    src="js/jquery-ui-1.8.6.custom.min.js">
</script>
<script type="text/javascript" src = "jquery.timeago.js"></script>
<!-- jQuery Code starts here-->
<script type="text/javascript">

function statusClickHandler() {
		/*Function to enable/disable status changes*/
		statusChangeEnabled = !statusChangeEnabled;
		$("#ShowHelp").hide('slow');
		
		if(statusChangeEnabled) {

			$("#change_status").html("<span>I'm done changing status</span>");
			$("#ShowHelp").hide('slow');
			$("#ShowHelp").html("Click on your current position on the map to update your status")		
			$("#ShowHelp").show('slow');		
		}		
		else {
			$("#change_status").html("<span>Update my status</span>");
			$("#ShowHelp").hide('slow');
			$("#ShowHelp").html("Find your position on the map by zooming or panning , if its not already there,then click the button above to update your status");
			$("#ShowHelp").show('slow');			
		}
		
		}

var statusChangeEnabled = false; // Global variable controlling status change option

$.ajaxSetup({
			cache:false
			});

$(document).ready(function(){
 

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
 
 
  var map,geocoder,info,smode=false,markersArray=[],k=0;
  
 
  function addMarker(location) {
  marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markersArray.push(marker);
}

// Deletes all markers in the array by removing references to them
function deleteOverlays() {
  if (markersArray) {
	  
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
    markersArray.length = 0;
  }
}
  
function initialize() {
    // Getting the position of the user thru auto-geolocation
	if (google.loader.ClientLocation) {
  		var latLng = new google.maps.LatLng(google.loader.ClientLocation.latitude,                 google.loader.ClientLocation.longitude);
		var zoom = 10;  		
  		}
   else        {
      var latLng = new google.maps.LatLng(0, 0);
  		var zoom = 1;
  		
  		//Find the user's previous location if unable to locate current location
  		<?php
  		if(isset($posn))
  			{
				//$posn is defined in the index controller.  				
  				if($posn['lat'] && $posn['lng'])	{
  					echo "latLng = new google.maps.LatLng($posn[lat], $posn[lng]);";
  					echo "zoom = 10;";
  					}
  			}
  		?>
}

    var myOptions = {
      zoom: zoom,
      center: latLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
     map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);


	 google.maps.event.addListener(map,'click',function (event) {
		if (statusChangeEnabled) {													 
			deleteOverlays();
			 addMarker(event.latLng);
			 var html = document.createElement("div");
			 
			 var btn = document.createElement("div");
			 btn.setAttribute('class','buttonwrapper');
			 
			 var span = document.createElement("a");
			 span.setAttribute('id','status_upd');
			 span.onclick =   function () {
			 		var foo = new Date; // Generic JS date object
					var unixtime_ms = foo.getTime(); // Returns milliseconds since the epoch
					var unixtime = parseInt(unixtime_ms / 1000);
				 addMarker2(event.latLng);
				 var msg = $("#st_text").val();
				 $.post('./setstatus.php',{ //check jQuery docs for this
										   uid:<?=$uid?>,
										   msg:msg,
										   lat:event.latLng.lat(),
										   lng:event.latLng.lng()
											}, function (data) {
													var loc = getAddress(event.latLng);
													feedHandler(msg,loc); });
													info.close();
													location.reload();
				 }
			 span.setAttribute('class','boldbuttons');
			 span.setAttribute('href','#');
			 span.innerHTML = '<span>Set Status</span>';
			 btn.appendChild(span);
			 html.innerHTML = '<textarea name="st_text" id="st_text"  ></textarea>';
			 html.appendChild(btn);
			 
			 addInfo(event.latLng,html);
			}						
			});
  
  }
  
  function addMarker2(latlng) {
	
	var marker = new google.maps.Marker({
										position:latlng,
										});
	marker.setMap(map);
}

	function addMarkerInfo(latlng,html) {
		
		var marker = new google.maps.Marker({
										position:latlng,
										});
		if(!info) {
		info = new google.maps.InfoWindow();
		}
		var htm = document.createElement("div");
		htm.innerHTML=html;
		htm.onload = function() {
			$('abbr.timeago').timeago();			
			}
		
		info.setContent(htm);
		google.maps.event.addListener(marker,'mouseover',function () {
						info.open(map,marker);
			});
	
			
		
		marker.setMap(map);		
		$("abbr.timeago").timeago();
		
		}

	function addInfo(latlng,html) {
		if(!info) {
		info = new google.maps.InfoWindow();
		}
		
		info.setContent(html);
		info.open(map,markersArray[0]);
		}

//Reverse Geocoding function
function getAddress(latLng) {
  // Check to see if a geocoder object already exists
  if (!geocoder) {
    geocoder = new google.maps.Geocoder();
  }
  // Creating a GeocoderRequest object
  var geocoderRequest = {
    latLng: latLng
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
<div id="apDiv1" class="design">
</div>
<div id="apDiv2" class="design2">
<a class ='boldbuttons' id="change_status" href='#' onClick="statusClickHandler()"><span>Update your status</span></a>
<br>
<br>
<br>
<a id="ShowHelp">Find your position on the map by zooming or panning , if its not already there,then click the button above to update your status</a>
<p class="help">Click on a status update below to map it!</p>
	</div>

  
<div id = "frnd_upd" class="design"></div>
<div id ="freq_d" title="Accept Request"></div>


<div id="map_canvas"></div>
  
<div id="fb-root"></div>
<div id ="fsug_d" title="Add friends" style="display:none"><img src="ajax-loader.gif" alt="Loading ..."  /></div>
<!-- For logging into Javascript API-->


<script>
	window.fbAsyncInit = function() {
	FB.init({
		appId : '129413090453935',
		session : <?=json_encode($session)?>, // don't refetch the session when PHP already has it
		status : true, // check login status
		cookie : true, // enable cookies to allow the server to access the session
		xfbml : true // parse XFBML
	});
	
	// whenever the user logs in, we refresh the page
	FB.Event.subscribe('auth.login', function() {
		window.location.reload();
	});
	};
	
	(function() {
		var e = document.createElement('script');
		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());
	
	/*Function to publish status updates to the user's wall*/
	function feedHandler(message,loc) {
		if (loc=="undefined"||(!loc))
			loc="undefined location."
		FB.ui(
	   {
	     method: 'feed',
	     name: 'mapTheGraph',
	     caption: 'Find where your friends are right now!',
	     message: message + ' at ' + loc,
	     actions: {
	     			name: "Visit mapTheGraph",
	     			link: "http://apps.facebook.com/maptg_one/"
	     				}
	     }, function(response) {
			     if (response && response.post_id) {
			       alert('Post was published.');
			     } else {
			       alert('Post was not published.');
			     }
			  }
);
		
		}
</script>
</body>
</html>