<?php
    include_once "fbmain.php";
    /*Controller file for preparing the app,when the user logs in*/
    /*TODO: Add random invite code*/
    if($fbme) {
    	$is_first_time = true;
		include_once "acceptreq.php";
		$user_query = "SELECT * FROM users1 WHERE uid = \"$uid\"";
		$temp1 = db_query($user_query);
		$check = mysql_fetch_array($temp1);
		if (!$check){
			
			$name = $fbme['name'];
			$query = "INSERT INTO users1 (uid,name) VALUES (\"$uid\",\"$name\")";
			
			$r = db_query($query);
			/*Code for accepting invites*/ 
			$query = "SELECT * FROM invites WHERE invited = \"$uid\"";
			$r = db_query($query);
			while($friend = mysql_fetch_array($r))
				accept_friend($uid,$friend['invited_by'],true,true);
			
			}
		else {
			/* Code for friend requests */
			$is_first_time	= false;		
			$query = "SELECT * FROM requests WHERE sent_to = \"$uid\"";
			$r = db_query($query);
			$friend_req_array = array();
			while($friend = mysql_fetch_array($r))
				$friend_req_array[] = $friend['sent_from'];

			/* Code for finding last set position of the user */			
				$r2 = db_query("SELECT * FROM users1 WHERE uid = \"$uid\"");
				$posn = mysql_fetch_array($r2);
			}
			
			if($is_first_time)
				include_once "firsttime.php";
			else 
				include_once "mapbase4.php";
		
	}
	 else 
		echo "Sorry , a database error occured";
			
    
?>