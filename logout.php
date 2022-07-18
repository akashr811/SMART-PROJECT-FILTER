<?php
include_once("config/config.php");	
include_once(getFolderPath()."classes/security.php");	
$security=new security();
$security->logout();
?>