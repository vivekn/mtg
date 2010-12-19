<?php
	include_once "fbmain.php";
?>
<html>
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


  // Extract the user ID's returned in the FQL request into a new array.  

   $print_or_not = false;  
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
   if($print_or_not)
   	echo $html;      
//we are going to store the random numbers in an array
//all random numbers will be different 

$limit = count($other_friends)>5?5:count($other_friends);
if($limit) {
	$keys = array_rand($other_friends,$limit);//array to store the random numbers

	echo "<h4>Would you like to expand your graph by adding these people?</h4><br>";
	
	foreach ($keys as $new_friend)  {
		echo "<span class='newfield'>{$other_friends[$new_friend]['name']} <a class = 'newfield' name='{$other_friends[$new_friend]['uid']}' href ='#'>Invite</a><br></span>";
		
		}
}
?>
</body>
</html>