<?php
$file = fopen("test.txt","w");
fwrite($file,print_r($_POST));
?>