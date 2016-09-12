<?php
include_once"objVersion/config.php";
session_start();
if(isset($_SESSION[sessionVariable])){
	echo "session started";
	}else{
		echo "Please start session as admin user";
		}
?>