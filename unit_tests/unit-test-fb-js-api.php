<?php
include_once "fbmain.php";
?>
<!-- For logging into Javascript API-->
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<title>Unit Test for facebook JS API</title>
</head>
<body>
<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
	FB.init({
		appId : '<?php echo $facebook->getAppId(); ?>',
		session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
		status : true, // check login status
		cookie : true, // enable cookies to allow the server to access the session
		xfbml : true // parse XFBML
	});
	
	// whenever the user logs in, we refresh the page
	FB.Event.subscribe('auth.login', function() {
		window.location.reload();
	});
	};
	
	(function() {
		var e = document.createElement('script');
		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());
	
	/*Function to publish status updates to the user's wall*/
	function feedHandler() {
		FB.ui(
	   {
	     method: 'feed',
	     name: 'mapTheGraph',
	     caption: 'Find where your friends are right now!',
	     message: 'is ',
	     actions: {
	     			name: "Visit mapTheGraph",
	     			link: "http://apps.facebook.com/maptg_one/"
	     				}
	     }, function(response) {
			     if (response && response.post_id) {
			       alert('Post was published.');
			     } else {
			       alert('Post was not published.');
			     }
			  }
);
		
		}
</script>
<a href="#" onclick="feedHandler()" >
	Click Here</a>
</body>
</html>