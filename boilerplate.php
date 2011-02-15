<?php

/*Wrapper for handling all database queries*/
function db_query($query) {
	mysql_connect('localhost','aagmh3tm','ixzrugomoazq');
	$db = mysql_select_db('aagmh3tm_mtg');
	
	if ($db && ($r = mysql_query($query)) ) 
		return $r;		
	else {
		
		die("Sorry , a database error occured:".mysql_error()."\n $query"); // remove this after testing phase is over
	}
}


?>