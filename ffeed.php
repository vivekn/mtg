<html>

<?php
/* The friend feed , ie , status and location updates of friends */

include_once "boilerplate.php";
include_once "fbmain.php";
include_once "prettyprint.php";	
$me = $_REQUEST['uid'];
$start = $_REQUEST['start'];

echo "<p>Updates from friends</p>";

if($start<=0) // if the page start index is negative, reset it.
	$start=0;

$query1 = "SELECT uid,lat,lng,status,timestamp FROM updates WHERE uid IN  (SELECT uid2 FROM connections WHERE uid1 = \"$me\") ORDER BY timestamp DESC";
$r = db_query($query1);

$i=0;

/*Fetches 3 latest updates from the user's friends*/
for($i=$start;$i<($start+3);$i++) {
	$result = mysql_fetch_array($r);
	$r2 = db_query("SELECT * FROM users1 WHERE uid = \"$result[uid]\"");
	$res2 = mysql_fetch_array($r2);
	
	if(!$result)
		break;
	$result['name'] = $res2['name'];
	print_update($result);
	}
if(!$i) {
echo '<p>It seems like you have no friends using this app yet!. Would you like to <a href="#" onclick="$(\'#fsug_d\').dialog({modal:true,minHeight: 250}).load(\'inv2.php\');">add</a> them or <a href = "inv3.php" target = "_top">invite</a> some?</p>';	
	
	}
/*for creating a page mechanism*/
if($start!=0)
	echo '<a id="prev" href = "#" onclick = \'$("#frnd_upd").load("ffeed.php","uid=$uid&start='.($start-3).';\'>prev</a>';
if(mysql_num_rows($r)>($start+3))
	echo '<a id="next" href = "#" onclick = \'$("#frnd_upd").load("ffeed.php","uid=$uid&start='.($start+3).'");\'>next</a>';

?>
<script type="text/javascript" >
$(document).ready(function () {
	$("abbr.timeago").timeago();
	});
</script>
</html>
