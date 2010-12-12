<html>
<?php
/* The friend feed , ie , status and location updates of friends */

include "boilerplate.php";
include "fbmain.php";

$me = $_REQUEST['uid'];
$start = $_REQUEST['start'];

echo "<p>Updates from friends</p><br/>";

if($start<=0)
	$start=0;

$query1 = "SELECT uid,lat,lng,status,timestamp FROM updates WHERE uid IN  (SELECT uid2 FROM connections WHERE uid1 = \"$me\")";
$r = db_query($query1);

$i=0;
//echo '<html><head><LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA=screen></head><body><div id ="" class = "">';
for($i=$start;$i<($start+5);$i++) {
	$result = mysql_fetch_array($r);
	if(!$result)
		break;
	$fbuser  = $facebook->api('/'.$result['uid']);
	echo '<img src = "" width="32" height ="32"/><a href="">$fbuser[name]</a><br>'.$result['status'].'@ { $result[lat] , $result[lng] } on $result[timestamp]  ';
	}
if($start!=0)
	echo '<a id="prev">prev</a>';
if(mysql_num_rows($r)>($start+5))
	echo '<a id="next">next</a>';

?>
</html>
