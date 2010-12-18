<?php  
include_once "fbmain.php";
    // Retrieve array of friends who've already added the app.  
$fql = 'SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1='.$user.') AND has_added_app = 1'; 
$_friends = $facebook->api_client->fql_query($fql); 
     
   // Extract the user ID's returned in the FQL request into a new array.  
$friends = array();  
if (is_array($_friends) && count($_friends)) {  
       foreach ($_friends as $friend) 
           $friends[] = $friend['uid'];  
   }      
//we are going to store the random numbers in an array
//all random numbers will be different 

$userid = array();          //array to store the random numbers
$p = count($_friends);
for($i = 0;$i <= 5; $i++)
{
	$s = 0;
	$userid[$i] =  (rand()%$p);          //any random number generation
	for($j = 0;$j <= $i; $j++)
		if($userid[$i] == $userid[$j])     //checking the possibility of occurence of this userid before in the same array
			$s = $s + 1;
	$i = $i - $s;
}

//6 people name will be displayed
//userid array store the required numbers to be reffered to ids to be displayed

   // Convert the array of friends into a comma-delimeted string.  
$friends = implode(',', $friends);  
     
   // Prepare the invitation text that all invited users will receive.  
$content = <<<FBML
<fb:name uid = "{$user}" firstnameonly =  "true" shownetwork="false"/> wants you to be on Map the Graph  
<fb:req-choice url="{$facebook->get_add_url()}" label="Add Map the Graph to your profile!"/>  
FBML;  

$more_content= <<<more_FBML
<fb:serverfbml style="width: 650px;">
<fb:request-form action="http://apps.facebook.com/mapthegraph/" method="POST" invite="true" type="Map the Graph" content="{htmlentities($content)}">  
<fb:multi-friend-selector max="6" actiontext="Here are some of your friends who haven't added Map the Graph to their profile. " showborder="true" rows="5" exclude_ids="{$friends}"/></fb:request-form></fb:serverfbml>
more_FBML;
echo $more_content;
?>
