<?php
    //facebook application
    //set facebook application id, secret key and api key here
    $fbconfig['appid' ] = "129413090453935";
    $fbconfig['api'   ] = "a0f5704cf371c0e78c8022b6ff84d576";
    $fbconfig['secret'] = "46a49698dbf476092c223971663895aa";

    //set application urls here
    $fbconfig['baseUrl']    =   "http://aagmh3tm.facebook.joyent.us/mapit/mapthegraph/"; //http://thinkdiff.net/demo/newfbconnect1/iframe;
    $fbconfig['appBaseUrl'] =   "http://apps.facebook.com/mapthegraph"; //;

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
            'canvas'    => 0,
            'fbconnect' => 1,
            'req_perms' => 'publish_stream, user_location'
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
