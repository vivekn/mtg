<?php
    //facebook application
    //set facebook application id, secret key and api key here
    $fbconfig['appid' ] = "";
    $fbconfig['api'   ] = "";
    $fbconfig['secret'] = "";

    //set application urls here
    $fbconfig['baseUrl']    =   ""; //http://thinkdiff.net/demo/newfbconnect1/iframe;
    $fbconfig['appBaseUrl'] =   ""; //http://apps.facebook.com/thinkdiffdemo;

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
            'req_perms' => 'email,publish_stream,status_update,user_birthday,user_location,user_work_history'
            )
    );

    $fbme = null;

    if (!$session) {
        echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        exit;
    }
    else {
        try {
            $uid      =   $facebook->getUser();
            $fbme     =   $facebook->api('/me');

        } catch (FacebookApiException $e) {
            echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
            exit;
        }
    }

    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
?>
