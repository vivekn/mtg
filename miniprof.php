
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
    <?php 
    	include_once "kygame.php";
		if ($GAME_ENABLED) {
				$sc = get_score($me);
				echo "<a style='float: left;'>Your Score: $sc </a><br><a style ='float: left;' href='#' onclick =\"$('#help').dialog({autoOpen:false,height:350,width:400}).load('help.htm').dialog('open').delay(30000).fadeIn('slow');\" >More info!</a>";
			}
    ?>
    <a href="inv3.php" target="_top" style="float: right;">Invite Friends</a>
    </div>
    <?php
    	if(!$t['timestamp'])
		echo "<script type=\"text/javascript\"> $('#help0').dialog({autoOpen: false, height: 220, width: 400, modal: true}).dialog('open') </script>"
    ?>
    <div id = "help" title = "mapTheGraph! Points" style="display: none;"/>
	 <div id = "help0" title = "Getting Started" style="display: none;">
		<p>
			Thanks for installing mapTheGraph. mapTheGraph! lets you share places you've been to with your friends. To get started with, try tagging your home, college or workplace or just any cool new place that you went to last weekend.</p> 
			<p>Simply move and zoom to the place you want to tag on the map, then click on the green "Update Status" on the right side of the map. Now a small window will pop, pick a tag and add a comment(optional), then hit "Set Status".</p>		
		</p>	 
	 </div>
<HR>
<script type="text/javascript" >
$(document).ready(function () {
	$("abbr.timeago").timeago();
	});
</script>
</html>

