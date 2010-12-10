<?php
include_once "boilerplate.php";
/* DB code for accepting friend requests and invitations */

function accept_friend($me,$requestor,$invite_mode) {

if ($invite_mode)
	$query1 = "DELETE * FROM invites WHERE (invited_by = \"$requestor\" AND invited = \"$me\")";
else
	$query1 = "DELETE * FROM friend_requests WHERE (requestor = \"$requestor\" AND requestee = \"$me\")";

$exec = db_query($query1);	

$query2 = "INSERT INTO users1 (uid,name) VALUES (\"$requestor\",\"$me\")";
$query3 = "INSERT INTO users1 (uid,name) VALUES (\"$me\",\"$requestor\")";
$exec = db_query($query2);
$exec = db_query($query3);
}

if ( isset($_REQUEST['uid1']) && isset($_REQUEST['uid2'] && ($_REQUEST['uid1']) && ($_REQUEST['uid2']) ) 
	accept_friend($_REQUEST['uid1'],$_REQUEST['uid2'],false);
?>