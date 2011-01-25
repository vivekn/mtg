<?php
	include_once "fbmain.php";
?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<style type="text/css">
a.newfield:hover {
background-color: red;
color: white; 
text-decoration: none;
float: right;
border:2px solid;
margin-bottom: 2px;
}

a.newfield {
background-color: white;
color: black;
text-decoration: none;
float: right;
border:2px solid; 
margin-bottom: 2px;
}

</style>
</head>
<body>
<h4>Invite your friends to mapTheGraph</h4>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" >
//Event handlers for Add and Invite buttons generated below
	$(document).ready(function () {	
	$('.newfield').click( function () {
		$(this).hide('slow');		
		var friendId = $(this).attr('name');		
		$.post('createreq.php',{
										uid:<?php echo $uid;?>,
										sent_to:friendId
											});
		});
		}
		);
</script>
    <?php  

	include_once "boilerplate.php";
	
    // Retrieve array of friends who've already added the app.  
   $fql = 'SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1='.$uid.') AND has_added_app = 1';
    // Retrieve array of friends who've not added the app.  
   $fql2 = 'SELECT uid,name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1='.$uid.') AND has_added_app = 0'; 
   $_friends = $facebook->api(array(  
 						'method' => 'fql.query',  
 						'query' =>$fql, 
 						'callback' => ''
							));  
	shuffle($_friends);
   $other_friends = $facebook->api(array(  
 						'method' => 'fql.query',  
 						'query' =>$fql2, 
 						'callback' => ''  
							));  


  
   $print_or_not = false;  // for the case if none of the user's friends have added the app.
   $items=0;//tracks the number of friends printed
   if (is_array($_friends) && count($_friends)) {  
		$html = "<h4>Some of your friends are already on mapTheGraph. Would you like to add them ?</h4><br>";     
        foreach($_friends as $friend) {  
        
        	$q = db_query("SELECT * FROM connections WHERE uid1 = $uid AND uid2 = $friend[uid]");
        	if ((!mysql_num_rows($q))&&$items<4) {
        		$print_or_not =true;
        		$html = $html . "<span class='newfield'>$friend[name]<a class = 'newfield' name='$friend[uid]' href ='#'>Add</a></span><br>";
        		$items++;
        		}
             
       }  
   }
        
 	$friends = array(); 
	foreach ($_friends as $friend) {  
           $friends[] = $friend['uid'];  
       }  
   $excl = implode(',', $friends);  
?>
   	
<div id="fb-root"></div>
<fb:serverfbml>
  <script type="text/fbml" >


     <fb:request-form action="<?=$fbconfig['baseUrl']?>proc_inv.php" method="POST" invite="true" type="mapTheGraph!" 
       content="Hi, I am using mapTheGraph, an app that lets you follow the cool places I've been to and where I am on a map.I would like to add you to my graph!.">
     <fb:multi-friend-selector actiontext="Invite your friends to use this app."  exclude_ids = "<?=$excl?>"/> 
  
  </fb:request-form>
</script>
  </fb:serverfbml>
  
  <script>
	window.fbAsyncInit = function() {
	FB.init({
		appId : '129413090453935',
		session : <?=json_encode($session)?>, // don't refetch the session when PHP already has it
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
	
	
	
</script>
</body>
</html>
