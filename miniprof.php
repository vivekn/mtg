
<html>
<LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA=screen>

    <div class="design">
     <?php
    	include "boilerplate.php";
    	include "prettyprint.php";
		$me = $_REQUEST['uid'];
		
		$query1 = "SELECT * FROM users1 WHERE uid = \"$me\"";
		$r = db_query($query1);
		$t =  mysql_fetch_array($r);
		$t['timestamp'] = $t['time']; 
		//^^due to an inconsistency in naming the timestamp in the tables users1 and updates

	?>
 	<img src="http://graph.facebook.com/<?=$me?>/picture/" alt=" " width="50" height="50" align="right"/>
    <h4><?=$t['name']?></h4>
    	<HR>
	<p>
   <?php print_status($t); ?>
    </p>
    <a href="inv3.php" target="_top" style="float: right;">Invite Friends</a>
    </div>
<HR>
<script type="text/javascript" >
$(document).ready(function () {
	$("abbr.timeago").timeago();
	});
</script>
</html>

