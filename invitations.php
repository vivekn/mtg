<?php
	echo "Testing..";
    //facebook application
    //set facebook application id, secret key and api key here
    $fbconfig['appid' ] = "129413090453935";
    $fbconfig['api'   ] = "a0f5704cf371c0e78c8022b6ff84d576";
    $fbconfig['secret'] = "46a49698dbf476092c223971663895aa";

    //set application urls here
    $fbconfig['baseUrl']    =   "http://aagmh3tm.facebook.joyent.us/mapit/mapthegraph/"; //http://thinkdiff.net/demo/newfbconnect1/iframe;
    $fbconfig['appBaseUrl'] =   "http://apps.facebook.com/maptg_one"; //;

    $uid            =   null; //facebook user id

    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        echo '<pre>';
        print_r($o);
        echo '</pre>';
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $session = $facebook->getSession();
    $loginUrl = $facebook->getLoginUrl(
            array(
            'canvas'    => 1,
            'fbconnect' => 0,
            'req_perms' => 'publish_stream,status_update,user_birthday,user_location,friends_location,friends_status'
            )
    );

    $fbme = null;

    if (!$session) {
		$loginUrl = str_replace("http://","https://",$loginUrl);
        echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        exit;
    }
    else {
        try {
            $uid      =   $facebook->getUser();
            $fbme     =   $facebook->api('/me');

        } catch (FacebookApiException $e) {
            
        }
    }

    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
?>


<html>
<head>
<style type="text/css">
.newfield:hover {
background-color: black;;
color: white; 
text-decoration: none;
}

.newfield {
background-color: white;
color: black;
text-decoration: none;
}
</style>
</head>
<body>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" >
//Event handlers for Add and Invite buttons generated below
	function click_handler() {
		$(this).hide('slow');		
		var friendId = $(this).attr('name');		
		$.post('createreq.php',{
										uid:<?php echo $uid;?>,
										sent_to:friendId
											});
		}
</script>
    <?php  

	include_once "boilerplate.php";
    // Retrieve array of friends who've already added the app.  
   $fql = 'SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1='.$uid.') AND has_added_app = 1'; 
   $fql2 = 'SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1='.$uid.') AND has_added_app = 0'; 
   $_friends = $facebook->api(array(  
 						'method' => 'fql.query',  
 						'query' =>$fql ,
 						'callback'    => ''
 
							));  
   $other_friends = $facebook->api(array(  
 						'method' => 'fql.query',  
 						'query' =>$fql2,
 						'callback'    => ''
  
							));  
   // Extract the user ID's returned in the FQL request into a new array.  
   $friends = array();
   $print_or_not = false;  
   if (is_array($_friends) && count($_friends)) {  
		$html = "<a>Some of your friends are already on mapTheGraph. Would you like to add them ?</a><br>";     
        foreach($_friends as $friend) {  
        	$q = db_query("SELECT * FROM connections WHERE uid1 = $uid");
        	if (!mysql_num_rows($q)) {
        		$print_or_not =true;
        		$html = $html . "<a>$friend[name]            </a><a class = 'newfield' name='$friend[uid]' onclick ='click_handler()' href ='#'>Add</a><br>";
        		}
             
       }  
   }
   if($print_or_not)
   	echo $html;      
//we are going to store the random numbers in an array
//all random numbers will be different 

$user = array();          //array to store the random numbers
$p = count($_friends);
for($i = 0;$i <= 5; $i++)
	{
	$s = 0;
	$user[$i] =  (rand()%$p);          //any random number generation
	for($j = 0;$j <= $i; $j++)
		if($user[$i] == $user[$j])     //checking the possibility of occurence of this userid before in the same array
			$s = $s + 1;
	$i = $i - $s;
}

echo "<br> <p>Would you like to expand your graph by adding these people?</p><br>";

foreach ($user as $new_friend)  {
	echo "<a>$other_friends[$new_friend][name]            </a><a class = 'newfield' name='$other_friends[$new_friend][uid]' onclick ='click_handler()' href ='#'>Invite</a><br>";
	
	}

?>
</body>
</html>
