<script type="text/javascript" >
function addToMap(uid, uname, ustatus, utime, lat, lng, geo, cent) {
/*function to create and append html to infowindows in the map representing status updates*/
	var latlngl = new google.maps.LatLng(lat, lng);
	var html = "<img src='http://graph.facebook.com/"+uid+"/picture/'  width='35' height='35' align='left'/><a> "+uname+"</a><br><a class='status'> "+ustatus+ " (" + geo + " ).";
	addMarkerInfo(latlngl,html);
	if (cent)
		map.setOptions({center: latlngl});
	$("abbr.timeago").timeago();// initializes timeago elements
}

</script>

<?php
/*Pretty printing library for status message,name etc*/

include_once "boilerplate.php";

function print_update($t) {
	$namehtml ="<br><img src='http://graph.facebook.com/$t[uid]/picture/'  width='35' height='35' align='left'/><a> $t[name]</a><br>";
	echo $namehtml;
	print_status($t);
}

function print_status($t){
	$html ="<a class='status' href='#' onclick = 'addToMap(\"$t[uid]\",\"$t[name]\",\"$t[status]\",\"$t[timestamp]\",$t[lat],$t[lng],\"$t[geodata]\",true);' > $t[status] </a><abbr class='timeago' title='$t[timestamp]'>$t[timestamp]</abbr> <a href='#'><img src = 'globe.png' title = 'Map this' width = '12' height = '12'  onclick = 'addToMap(\"$t[uid]\",\"$t[name]\",\"$t[status]\",\"$t[timestamp]\",$t[lat],$t[lng],\"$t[geodata]\",true);'/></a><br>";

if(isset($t['tag'])&&$t['tag']) 
	$html ="<a class='status' href='#' onclick = 'addToMap(\"$t[uid]\",\"$t[name]\",\"$t[status]\",\"$t[timestamp]\",$t[lat],$t[lng],\"$t[geodata]\",true);'> $t[status] </a><abbr class='timeago' title='$t[timestamp]'>$t[timestamp]</abbr><br> <img src = '$t[img]' title = '$t[tag]' width = '12' height = '12'/> <a href ='#'><img src = 'globe.png' title = 'Map this' width = '12' height = '12'  onclick = 'addToMap(\"$t[uid]\",\"$t[name]\",\"$t[status]\",\"$t[timestamp]\",$t[lat],$t[lng],\"$t[geodata]\",true);' /></a><br>";


if($t['timestamp'])
	echo $html;

}

?>

