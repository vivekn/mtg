<?php
include "boilerplate.php";
$me = $_REQUEST['uid'];
$msg = $_REQUEST['msg'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];


$mysqldate = date('Y-m-d H:i:s');

$query1 = "INSERT INTO updates VALUES (\"$me\",$lat,$lng,\"$msg\",\"$mysqldate\")";
$query2 = "UPDATE users1 SET lat=$lat , lng=$lng , status = \"$msg\" , time = \"$mysqldate\" WHERE uid = \"$me\"";
$r = db_query($query1);
$r1 = db_query($query2);
if($r and $r1)
	echo '100';//Success 
else
    echo '200';//Failure
	
?>
