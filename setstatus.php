<?php

/*
*	Updates the status in the database,called from the set status dialog in the UI.
*/
include "boilerplate.php";
include_once "fbmain.php";
$tag = '';
$me = $_REQUEST['uid'];
$msg = $_REQUEST['msg'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
$tag = $_REQUEST['tag'];

$wall = $msg;

$mysqldate = date('Y-m-d H:i:s');//Gets the current server time and converts it to MySQL format.
$tag_data = array();

if($tag) {
	$checktag = "SELECT * FROM tags WHERE tag=\"$tag\"";
	$ct = db_query($checktag);
	if($ct) {
			$tag_data = mysql_fetch_array($ct);
		}
}

$query1 = "INSERT INTO updates VALUES (\"$me\",$lat,$lng,\"$msg\",\"$mysqldate\",$tag)";
$query2 = "UPDATE users1 SET lat=$lat , lng=$lng , status = \"$msg\" , time = \"$mysqldate\" WHERE uid = \"$me\"";
$r = db_query($query1);
$r1 = db_query($query2);

//TODO tag_database - tag tag_msg img type


if($r and $r1) {
	echo '100';//Success 
	if (!$tag_data) {
	$result = $facebook->api(
            '/me/feed/',
            'post',
            array('message' => "$wall .                       powered by mapTheGraph - try it here                   http://apps.facebook.com/maptg_one")
        );
}
	else {
			$result = $facebook->api(
            '/me/feed/',
            'post',
            array('message' => "$fbme[first_name] $tag_data[message]",
            		'link' => "http://apps.facebook.com/maptg_one",
            		'caption' => 'Click here to visit mapTheGraph now!',
            		'image' => $fbconfig['baseUrl'].$tag_data['image']
            		)
        );
		
		}

}
else
    echo '200';//Failure
	
?>
