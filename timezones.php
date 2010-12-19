<?php
//For converting between different time zones

function getLocalTime($server_time,$offset) {


$newtime = strtotime($server_time);
$newtime = $newtime - (60*$offset);
$userdate = date('Y-m-d H:i:s',$newtime);
return $userdate;

}
?>