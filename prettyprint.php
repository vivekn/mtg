<script type="text/javascript" >
function addToMap(update, cent) {
/*function to create and append html to infowindows in the map representing status updates*/
	update.lat = parseFloat(update.lat);
	update.lng = parseFloat(update.lng);
	var latlngl = new google.maps.LatLng(update.lat, update.lng);
	
	if (update.geo)
		update.geo = " (" + update.geo + " ).";
	var html = "<img src='http://graph.facebook.com/"+update.uid+"/picture/'  width='35' height='35' align='left'/><a> "+update.name+"</a><br><a class='status'> "+update.status+" @ "+update.geodata;
	addMarkerInfo(latlngl, html);
	if (cent)
		map.setOptions({center: latlngl});
	$("abbr.timeago").timeago();// initializes timeago elements
}

</script>
<?php
/*Pretty printing library for status message,name etc*/

include_once "boilerplate.php";
include "smarty_incl.php";
function print_update($q) {
	
	$GLOBALS['smarty']->clearAllCache();
	$GLOBALS['smarty']->clearAllAssign();
	$GLOBALS['smarty']->assign('object', json_encode($q));
	$GLOBALS['smarty']->assign('t', $q);
	$GLOBALS['smarty']->display('status.tpl');
}

?>

