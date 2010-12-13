<!DOCTYPE html>
<html>
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

<!-- jQuery Code starts here-->
<script type="text/javascript">

function statusClickHandler() {
		
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
			$("#ShowHelp").html("Find your position on the map by zooming or panning , if its not already there,then click the button above to update your status")		
			$("#ShowHelp").show('slow');			
		}
		
		}

var statusChangeEnabled = false; // Global variable controlling status change option

$.ajaxSetup({
			cache:false
			});

$(document).ready(function(){
 <?php
 /*$uid = 800; // For Testing purposes
 $friend_req_array = array();*/
 ?>
  $('#frnd_upd').load('ffeed.php',"uid=<?=$uid?>&start=0");
  $('#apDiv1').load('miniprof.php',"uid=<?=$uid?>");
  $("#ShowHelp").show();

  /* Add code for friend requests after going through jQuery AJAX API */
  
   <?php
   
  foreach ($friend_req_array as $sth) {
  //$('#fsug_d').dialog({autoOpen:false,modal:true}).load("friendsuggestion.html");
  // edit the index controller,add reject feature
  echo "jQuery('#freq_d$sth').dialog({autoOpen:false,modal:true}).load('frequest.php','uid=$sth&me=$uid?>');";
  echo "jQuery('#accept$sth').click(function() {jQuery.post('acceptreq.php',{ sent_from:$sth,uid:$uid});jQuery('#freq_d$sth').dialog('close');});";
  echo "jQuery('#reject$sth').click(function() {jQuery('#freq_d$sth').dialog('close');})";
  echo "jQuery('#freq_d$sth').dialog('open')";
  }
	?>

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
 
 
  var map,info,smode=false,markersArray=[],k=0;
  $("boldbuttons").click(function() {
								  notif();
								  event.preventDefault();
								  });
 
  function addMarker(location) {
  marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markersArray.push(marker);
}

// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
  }
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
				 addMarker2(event.latLng);
				 $.post('./setstatus.php',{ //check jQuery docs for this
										   uid:<?=$uid?>,
										   msg:$("#st_text").val(),
										   lat:event.latLng.lat(),
										   lng:event.latLng.lng()
											}, function (data) {
												alert("Yay! your status has been updated"); });
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

	function addInfo(latlng,html) {
		if(!info) {
		info = new google.maps.InfoWindow();
		}
		
		info.setContent(html);
		info.open(map,markersArray[0]);
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
<p id="ShowHelp">Find your position on the map by zooming or panning , if its not already there,then click the button above to update your status</p>
	</div>
  
<div id = "frnd_upd" class="design"></div>
<div id ="freq_d" title="Accept Request"></div>
<div id ="fsug_d" title="Friend Suggestions"></div>

<div id="map_canvas"></div>
  
    
</body>
</html>