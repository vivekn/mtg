
<?php include "fbmain.php";
 

$result = $facebook->api(
            '/me/feed/',
            'post',
            array('message' => ' is now using mapTheGraph. Try mapTheGraph now! - share and discover new places to hang out at or explore. Click on the link to check it out.   http://apps.facebook.com/maptg_one ')
        );

?>
