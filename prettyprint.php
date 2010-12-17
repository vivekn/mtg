<?php
/*Pretty printing library for time difference,status message,name etc*/

function print_status($t){
echo "Hello";

$maphtml = "<img src='http://graph.facebook.com/$me/picture/'  width='50' height='50' align='left'/><a> $t[name]</a><br><a class='status'> $t[status]</a><abbr class='timeago' title='$t[timestamp]'></abbr>";

$html ="<img src='http://graph.facebook.com/$me/picture/'  width='50' height='50' align='left'/><a> $t[name]</a><br><a class='status' onclick = 'var latlngl = new google.maps.LatLng($t[lat], $t[lng]);var html = '$maphtml';addMarkerInfo(latlngl,html);'> $t[status] </a><abbr class='timeago' title='$t[timestamp]'s></abbr>	";

echo $html;

}

?>
