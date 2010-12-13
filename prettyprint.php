<?php
/*Pretty printing library for time difference,status message,name etc*/

include_once "boilerplate.php";

function print_name($uid) {
	
	$query = "SELECT * FROM users1 WHERE uid = \"$me\"";
	$r = db_query($query);
	$t =  mysql_fetch_array($r);	
	echo $t['name'];
	mysql_close($r);
	
	}
function print_status($uid){
	$query = "SELECT * FROM users1 WHERE uid = \"$me\"";
	$r = db_query($query);
	$t =  mysql_fetch_array($r);	
	echo $t['status'];
	mysql_close($r);	
	}
function print_time_diff($time){
	echo '<abbr class="timeago" title="'.$time.'"></abbr>';
	}

?>