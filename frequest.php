<html>

<?php
	/*Code for accepting a friend request*/

	$user = $_REQUEST['uid']; //The user who sent the friend request.
	$self = $_REQUEST['me']; //The current user.
	include "boilerplate.php";
	
	//Get name of the other user.
	$query1 = "SELECT name FROM users1 WHERE uid = \"$user\"";
	$r = db_query($query1);
	$n = mysql_fetch_array($r);
	$name = $n['name'];
?>
<h5>Would you like add <?= $name ?> to your graph?</h5>
<img src="http://graph.facebook.com/<?=$user?>/picture/?type=large" alt=" " width="64" height="64" align="left"/>

&nbsp;
<br>
<!-- Accept the request,call acceptreq.php-->
<a id = "accept<?=$user?>" class ='boldbuttons' href='#' onclick="jQuery.post('acceptreq.php',{ uid1:<?=$self?>,uid2:<?=$user?>,accepted:true});jQuery('#freq_d<?=$user?>').dialog('close');"><span>Accept</span></a>       
                       
<a class ='boldbuttons' href='#' onclick="jQuery.post('acceptreq.php',{ uid1:<?=$self?>,uid2:<?=$user?>,accepted:false});$('#freq_d<?=$user?>').dialog('close');"><span>Reject</span></a>	

</html>
