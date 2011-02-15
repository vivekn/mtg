<?php
/*File to track invitations sent*/
include_once "fbmain.php";
include_once "kygame.php";
if(isset($_REQUEST['ids'])){
		$friends = $_REQUEST['ids'];
		foreach ($friends as $friend) 
			$rs = file_get_contents("$fbconfig[baseUrl]createreq.php?uid=$uid&sent_to=$friend");
			game_invite_user($uid);
		}
	
		?>
		<html>
<script type="text/javascript" >
window.location = "<?=$fbconfig['appBaseUrl']?>";
</script>
</html>
