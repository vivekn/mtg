<html>

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
<a id = "accept<?=$user?>" class ='boldbuttons' href='#' onclick="jQuery.post('acceptreq.php',{ uid1:<?=$self?>,uid2:<?=$user?>});jQuery('#freq_d<?=$user?>').dialog('close');"><span>Accept</span></a>       
                       
<a class ='boldbuttons' href='#' onclick="$('#freq_d<?=$user?>').dialog('close');"><span>Reject</span></a>	

</html>
