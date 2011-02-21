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
	
$upper_limit = $start + 4;
$query1 = "SELECT uid,lat,lng,status,timestamp,tag FROM updates WHERE uid IN  (SELECT uid2 FROM connections WHERE uid1 = \"$me\") ORDER BY timestamp DESC LIMIT $start, $upper_limit";
$r = db_query($query1);
$i=0;
/*Fetches 4 latest updates from the user's friends*/
for($i=$start;$i<($start+4);$i++) {
	$result = mysql_fetch_array($r);
   $r2 = db_query("SELECT * FROM users1 WHERE uid = \"$result[uid]\"");
   $res2 = mysql_fetch_array($r2);
   $r3 = db_query("SELECT image FROM tags WHERE name = \"$result[tag]\"");
   $res3 = mysql_fetch_array($r3);
   if(!$result)
   	break;
   $result['name'] = $res2['name'];
   $result['img'] = $res3['image'];
   print_update($result);
 }
        
        
if(!$i) 
echo '<p>It seems like you have no friends using this app yet!. Would you like to <a href = "inv3.php" target = "_top">invite</a> some?</p>';
/*for creating a page mechanism*/
// dummy query to get no of rows
$query1 = "SELECT * FROM updates WHERE uid IN  (SELECT uid2 FROM connections WHERE uid1 = \"$me\")";
$r = db_query($query1);

if($start!=0){
        echo '<a id="prev" href = "#" onclick = \'$("#frnd_upd").load("ffeed.php","uid='.$uid.'&start='.($start-4).'");\';\'>prev</a>';}
if(mysql_num_rows($r)>($start+4))
        echo '<a id="next" href = "#" onclick = \'$("#frnd_upd").load("ffeed.php","uid='.$uid.'&start='.($start+4).'");\'>next</a>';

?>
<script type="text/javascript" >
$(document).ready(function () {
        $("abbr.timeago").timeago();
});
</script>
</html>
