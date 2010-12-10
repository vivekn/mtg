<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Testing</title>
<script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
     <script type="text/javascript">
       FB.init({
         appId  : '154741877870996',
         status : true, // check login status
         cookie : true, // enable cookies to allow the server to access the session
         xfbml  : true  // parse XFBML
       });
     </script>
</head>

<body>
<?php
require '../src/facebook.php';

$facebook = new Facebook(new array(
								   'appId' => '154741877870996',
								   'secret' => 'a815bff88e0b9b3324e088138df2afc5',
								   'cookie' => true
								   ));
$session = $facebook->getSession();
$login = $facebook->getLoginUrl(new array(
										  'canvas' => 1,
										  'fbconnect' => 0,
										  'req_perms' => 'email'
										  ));

if(!$session) {
	echo 'Redirecting ....<br>';
	echo "<script type='text/javascript'>top.location.href = '$login';</script>";
	exit;
}
	else {
		echo 'You have been successfully logged in.<br>';
		}
?>
</body>
</html>