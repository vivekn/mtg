<?php
/* For creating invites or friend requests */

include "boilerplate.php";
$me = $_REQUEST['uid'];
$sent_to = $_REQUEST['sent_to'];

/*check whether invited person is using our app first*/

$user_query = "SELECT * FROM users1 WHERE uid = \"$sent_to\"";
$temp1 = db_query($user_query);
$check = mysql_fetch_array($temp1);

if (!$check)
	$query1 = "INSERT INTO invites VALUES (\"$sent_to\",\"$me\")";
else	
	$query1 = "INSERT INTO requests VALUES (\"$me\",\"$sent_to\")";
	
$r = db_query($query1);
?>
