<?php

/*
*	Updates the status in the database,called from the set status dialog in the UI.
*/
include "boilerplate.php";
include_once "fbmain.php";
include_once "kygame.php";
$tag = '';
$geo = '';
$geodata = '';
$me = $_REQUEST['uid'];
$msg = $_REQUEST['msg'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
$tag = $_REQUEST['tag'];
$loc =null;

if (isset($_REQUEST['loc']))
	$loc = $_REQUEST['loc'];
$wall = $msg;
//TODO: Add column "geodata" in table updates
$mysqldate = date('Y-m-d H:i:s');//Gets the current server time and converts it to MySQL format.
$tag_data = array();

if($tag) {
	$checktag = "SELECT * FROM tags WHERE name=\"$tag\"";
	$ct = db_query($checktag);
	if($ct) {
			$tag_data = mysql_fetch_array($ct);
	}
}


//Geocoding with cURL
$ch = curl_init("http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&sensor=true");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
$georesults = json_decode(curl_exec($ch));
if($georesults) {
	$geo = " @ " . ($georesults->results[0]->formatted_address);
	$geodata = $georesults->results[0]->formatted_address;
}
$geo = $geo . " - ( $lat, $lng )";

$query1 = "INSERT INTO updates VALUES (\"$me\",$lat,$lng,\"$msg\",\"$mysqldate\",\"$tag\",\"$geodata\")";
$query2 = "UPDATE users1 SET lat=$lat , lng=$lng , status = \"$msg\" , time = \"$mysqldate\", geodata = \"$geodata\" WHERE uid = \"$me\"";
$r = db_query($query1);
$r1 = db_query($query2);


if($r and $r1) {
	echo '100';//Success 
	if (!$tag_data) {
		$result = $facebook->api(
   		'/me/feed/',
      	'post',
      	array('message' => "$wall$geo.                       powered by mapTheGraph - try it here                   $fbconfig[appBaseUrl]")
       	 );
    	game_status_update($me);
	}
	else {
		$result = $facebook->api(
            '/me/feed/',
            'post',
            array('message' => "$fbme[first_name] $tag_data[message]$geo.",
            		'link' => "http://apps.facebook.com/mapthegraph",
            		'name' => 'Click here to visit mapTheGraph now! .Find where your friends are right now!',
            		'picture' => $fbconfig['baseUrl'].$tag_data['image']
            		)
        );
		game_new_tag($me);
		}

}
else
    echo '200';//Failure
	
?>
