<?php
include_once "boilerplate.php";
/* DB code for accepting friend requests and invitations */

function accept_friend($me,$sent_from,$invite_mode) {

	if ($invite_mode)
		$query1 = "DELETE * FROM invites WHERE (invited_by = \"$sent_from\" AND invited = \"$me\")";
	else
		$query1 = "DELETE * FROM requests WHERE (sent_from = \"$sent_from\" AND sent_to = \"$me\")";
	
	$exec = db_query($query1);	
	
	$query2 = "INSERT INTO connections (uid1,uid2) VALUES (\"$sent_from\",\"$me\")";
	$query3 = "INSERT INTO connections (uid2,uid1) VALUES (\"$me\",\"$sent_from\")";
	$exec = db_query($query2);
	$exec = db_query($query3);
}

if ( isset($_REQUEST['uid1']) && isset($_REQUEST['uid2']) && ($_REQUEST['uid1']) && ($_REQUEST['uid2']) ) 
	accept_friend($_REQUEST['uid1'],$_REQUEST['uid2'],false);
?>