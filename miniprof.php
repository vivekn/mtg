
<html>
<LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA=screen>
    <div class="design">
     <?php
    	include "boilerplate.php";
		$me = $_REQUEST['uid'];
		
		$query1 = "SELECT * FROM users1 WHERE uid = \"$me\"";
		$r = db_query($query1);
		$t =  mysql_fetch_array($r);

$status = <<<STATUS
<a class="status" onclick = "var latlngl = new google.maps.LatLng({$t['lat']}, {$t['lng']});var html = '{$t['status']}';addMarkerInfo(latlngl,html);"> {$t['status']} </a>
<abbr class="timeago" title="{$t['time']}"></abbr>			
STATUS;
	?>
 	<img src="http://graph.facebook.com/<?=$me?>/picture/" alt=" " width="50" height="50" align="right"/>
    <h4><?=$t['name']?></h4>
    	<HR>
	<p>
   <?php echo $status;?>
    </p>
    <a href="#" onclick="jQuery('#fsug_d').dialog({modal:true,minHeight: 300}).load('inv2.php');">Invite/Add Friends</a>
    </div>
<HR>
   
</html>

