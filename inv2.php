<?php
	include_once "fbmain.php";
?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<style type="text/css">
a.newfield:hover {
background-color: red;
text-decoration: none;
color: white; 
}

a.newfield {
background-color: white;
color: red;
border-bottom: dotted 1px;
float: right;
border:2px solid; 
margin: 2px;
}

</style>
</head>
<body>
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
        		$html = $html . "<div class='newfield'>$friend[name]<a class = 'newfield' name='$friend[uid]' href ='#'>Add</a></div><br>";
        		$items++;
        		}
             
       }  
   }
   if($print_or_not)
   	echo $html;
   	echo "<div style = 'clear: both;'></div>";      
 

?>

</body>
</html>