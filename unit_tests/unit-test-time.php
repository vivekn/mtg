<?php
$mysqldate = date( 'Y-m-d H:i:s', time() );
$phpdate = strtotime( $mysqldate );
echo $mysqldate;
?>
