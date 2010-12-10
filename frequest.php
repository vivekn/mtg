
<html>

<LINK REL=StyleSheet HREF="design.css" TYPE="text/css" MEDIA=screen>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>

<div class = "design2">
<?php
	/*Code for accepting a friend request*/

	$user = $_REQUEST['uid'];
	$self = $_REQUEST['me'];
	include "boilerplate.php";
	
	$query1 = "SELECT name FROM users1 WHERE uid = \"$user\"";
	$r = db_query($query1);
	$n = mysql_fetch_array($r);
	$name = $n['name'];
?>
<h5>Would you like add <?= $name ?> to your graph?</h5>
<img src="http://graph.facebook.com/<?=$user?>/picture/?type=large" alt=" " width="64" height="64" align="left"/>

&nbsp;
<br>
<a id = "accept<?=$user?>" class ='boldbuttons' href='#' onClick=""><span>Accept</span></a>       
                       
<a id = "reject<?=$user?>" class ='boldbuttons' href='#'><span>Reject</span></a>	
</div>													
</html>
