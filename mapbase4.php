<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.6.custom.css" media="screen"/>

<title>mapthegraph!</title>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="ui/jquery.ui.dialog.js"></script>
	<script src="ui/jquery.ui.mouse.js"></script>
	<script src="ui/jquery.ui.draggable.js"></script>
	<script src="ui/jquery.ui.position.js"></script>
	<script src="ui/jquery.ui.resizable.js"></script>
<LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA="screen">


<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript"
    src="js/jquery-ui-1.8.6.custom.min.js">
</script>

<!-- jQuery Code starts here-->
<script type="text/javascript">

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
  $("#ShowHelp").toggle('fast');

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
<!-- jQuery Code ends here-->
 <script type="text/javascript">
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
    var latlng = new google.maps.LatLng(18.986, 72.832);
    var myOptions = {
      zoom: 8,
      center: latlng,
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

	function statusClickHandler() {
		
		statusChangeEnabled = !statusChangeEnabled;
		$("#change_status").click(function () {
			$("#ShowHelp").toggle('slow');
			if(statusChangeEnabled) 
				$("#change_status").html("<span>Hide help</span>");
			else 
				$("#change_status").html("<span>Change status</span>");
			});
		
		}
</script>
</head>
<body onLoad="initialize()">
<a id="msgdown" ></a>
  <div id="apDiv1" class="design">
 
  </div>
   <div id="apDiv2" class="design2">
		 <a class ='boldbuttons' id="change_status" href='#' onClick="statusClickHandler()"><span>Change Status</span></a>
		 <br/>
		 <p id="ShowHelp">Click on the map to set your status</p>
	</div>
  
<div id = "frnd_upd" class="design"></div>
<div id ="freq_d" title="Accept Request"></div>
<div id ="fsug_d" title="Friend Suggestions"></div>

<div id="map_canvas"></div>
  
    
</body>
</html>