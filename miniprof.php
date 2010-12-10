
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
 	<img src="http://graph.facebook.com/<?=$me?>/picture/?type=large" alt=" " width="128" height="128" align="right"/>
    <p> <?=$t['name']?></p>
	<HR>
	<p>
   <?=$t['status']?>
    </p>
    </div>
    <div class ="design2">
<!-- Button Here - toggle styles with jQuery-->
</div>
<HR>
   
</html>

