<html>
<script type="text/javascript" >
function addToMap(uid,uname,ustatus,utime,lat,lng) {
	var latlngl = new google.maps.LatLng(lat, lng);
	var html = "img src='http://graph.facebook.com/"+uid+"/picture/'  width='35' height='35' align='left'/><a> "+uname+"</a><br><a class='status'> "+ustatus+"</a><abbr class='timeago' title='"+utime+"'>"+utime+"</abbr>";
	addMarkerInfo(latlngl,html);
	map.setOptions({center: latlngl});
	}
</script>
<?php
/*Pretty printing library for time difference,status message,name etc*/

function print_status($t){


$html ="<br><img src='http://graph.facebook.com/$t[uid]/picture/'  width='35' height='35' align='left'/><a> $t[name]</a><br><a class='status' onclick = 'addToMap(\"$t[uid]\",\"$t[name]\",\"$t[status]\",\"$t[timestamp]\",$t[lat],$t[lng]);'> $t[status] </a><abbr class='timeago' title='$t[timestamp]'>$t[timestamp]</abbr><br>";

echo $html;

}

?>
</html>