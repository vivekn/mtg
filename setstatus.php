<?  cinclude "boilerplate.php";
$me = $_REQUEST['uid'];
$msg = $_REQUEST['msg'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];

$mysqldate = date( 'Y-m-d H:i:s', time() );
$phpdate = strtotime( $mysqldate );

$query1 = "INSERT INTO updates VALUES (\"$me\",$lat,$lng,\"$msg\",$phpdate)";
$query2 = "UPDATE users1 SET lat=$lat , lng=$lng , status = \"$msg\" , time = $phpdate WHERE uid = \"$me\"";
$r = db_query($query1);
$r1 = db_query($query2);
if($r and $r1)
	echo '100';//Success 
else
    echo '200';//Failure
	
?>
