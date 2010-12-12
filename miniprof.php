
<html>
<LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA=screen>
    <div class="design">
     <?php
    	include "boilerplate.php";
		$me = $_REQUEST['uid'];
		
		$query1 = "SELECT * FROM users1 WHERE uid = \"$me\"";
		$r = db_query($query1);
		$t =  mysql_fetch_array($r);
	?>
 	<img src="http://graph.facebook.com/<?=$me?>/picture/" alt=" " width="50" height="50" align="right"/>
    <h4><?=$t['name']?></h4>
    	<HR>
	<p>
   <?=$t['status']?>
    </p>
    </div>
<HR>
   
</html>

