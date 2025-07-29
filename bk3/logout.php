<?php
	
	ob_start();
	
	session_start();
	
	if(isset($_SESSION['happi_admin_loggedin']))
		unset($_SESSION['happi_admin_loggedin']);
	
	session_destroy();
	
	header("Location:index.php");
	exit;
	
?>