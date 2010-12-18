<?php
include "boilerplate.php";

$r = db_query("SELECT * FROM users1");
if($r)
	echo "Success:".$r;
$mysqldate = date( 'Y-m-d H:i:s',time() );
$phpdate = strtotime( $mysqldate );
echo $phpdate." ".$mysqldate;
?>