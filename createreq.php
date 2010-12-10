<?php
/* For creating invites or friend requests */

include "boilerplate.php";
$me = $_REQUEST['uid'];
$requestee = $_REQUEST['requestee'];

/*check whether invited person is using our app first*/

$user_query = "SELECT * FROM users1 WHERE uid = \"$requestee\"";
$temp1 = db_query($user_query);
$check = mysql_fetch_array($temp1);

if (!$check)
	$query1 = "INSERT INTO invites VALUES (\"$requestee\",\"$me\")";
else	
	$query1 = "INSERT INTO friend_requests VALUES (\"$me\",\"$requestee\")";
	
$r = db_query($query1);
?>