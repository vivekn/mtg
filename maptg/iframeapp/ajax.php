<?php
    include_once "fbmain.php";

    if ($fbme){
        //update user's status using graph api
        if (isset($_REQUEST['status'])) {
            try {
                $status       = htmlentities($_REQUEST['status'], ENT_QUOTES);
                $statusUpdate = $facebook->api('/me/feed', 'post', array('message'=> $status, 'cb' => ''));
            } catch (FacebookApiException $e) {
                d($e);
            }
            echo "Status Update Successfull. ";
            exit;
        }
    }
?>