<?php
/*File to track invitations sent*/
include_once "fbmain.php";
if(isset($_REQUEST['ids'])){
		$friends = $_REQUEST['ids'];
		foreach ($friends as $friend) 
			$rs = file_get_contents("$fbconfig[baseUrl]createreq.php?uid=$uid&sent_to=$friend");
		}
	
		?>
		<html>
<script type="text/javascript" >
window.location = "<?=$fbconfig['appBaseUrl']?>";
</script>
</html>