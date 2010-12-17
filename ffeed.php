<html>

<?php
/* The friend feed , ie , status and location updates of friends */

include_once "boilerplate.php";
include_once "fbmain.php";
include_once "prettyprint.php";	
$me = $_REQUEST['uid'];
$start = $_REQUEST['start'];

echo "<p>Updates from friends</p><br/>";

if($start<=0)
	$start=0;

$query1 = "SELECT uid,lat,lng,status,timestamp FROM updates WHERE uid IN  (SELECT uid2 FROM connections WHERE uid1 = \"$me\")";
$r = db_query($query1);

$i=0;

for($i=$start;$i<($start+5);$i++) {
	$result = mysql_fetch_array($r);
	$r2 = db_query("SELECT * FROM users1 WHERE uid = \"$me\"");
	$res2 = mysql_fetch_array($r2);
	
	if(!$result)
		break;
	$result['name'] = $res2['name'];
	print_status($result);
	}
if($start!=0)
	echo '<a id="prev" onclick = "$("#frnd_upd").load("ffeed.php","uid=$uid&start={$start-5}");">prev</a>';
if(mysql_num_rows($r)>($start+5))
	echo '<a id="next" onclick = "$("#frnd_upd").load("ffeed.php","uid=$uid&start={$start+5}");">next</a>';

?>
</html>
