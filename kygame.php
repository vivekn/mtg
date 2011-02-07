<?php
include_once "boilerplate.php";

$GAME_ENABLED = false;


function check_user() {
	//checks if user exists
	$r = db_query("SELECT * FROM game WHERE uid=\"$uid\"");
	$t = mysql_fetch_array($r);
	
	if($t)
		return;
	else
		$r = db_query("INSERT INTO game VALUES (\"$uid\",0");	
	
	}


function update_score($user,$score_offset) {
	if ($GAME_ENABLED) {
		check_user();
		$r = db_query("SELECT * FROM game WHERE uid=\"$uid\"");
		$t = mysql_fetch_array($r);
	
		$newscore = (int) $t['score'];
		$newscore += $score_offset;
		$r = db_query("UPDATE game SET score = $newscore WHERE uid=\"$uid\"");

	}
	}
function game_invite_user($user) {
	update_score($user,3);	
	}

function game_invite_accepted($user) {
	update_score($user,13);	
	}

function game_status_update($user) {
	update_score($user,12);	
	}

function game_new_tag($user) {
	update_score($user,24);	
	}

function get_score() {
	$r = db_query("SELECT * FROM game WHERE uid=\"$uid\"");
	$t = mysql_fetch_array($r);
	$score = 0;	
	if($t) {
	$score = (int) $t['score'];	
	}
	
	return $score;
}
	
?>
