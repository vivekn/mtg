<html>
<script type="text/javascript" src = "js/jquery-ui-1.8.6.custom.min.js" >
</script>
<script type="text/javascript" src = "jquery.timeago.js">
</script>
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
//echo '<html><head><LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA=screen></head><body><div id ="" class = "">';
for($i=$start;$i<($start+5);$i++) {
	$result = mysql_fetch_array($r);
	if(!$result)
		break;
	$fbuser  = $facebook->api('/'.$result['uid']);
	echo '<img src = "http://graph.facebook.com/'.$me.'/picture/" width="32" height ="32"/>.<fb:name uid = "'.$user.'" linked ="false"/>'.$result['status'].'@ \{ $result[lat] , $result[lng] \} on'.print_time_diff($result[timestamp]);
	}
if($start!=0)
	echo '<a id="prev">prev</a>';
if(mysql_num_rows($r)>($start+5))
	echo '<a id="next">next</a>';

?>
</html>
