<?php
	ob_start();
	session_start();
	
	global $happi_admin_loggedin;
	global $admin_id;
	global $error;
	global $success;
	global $message;
	global $rUrl;
	global $cUrl;
	global $host;
	global $base_url;
	global $db;
	global $session_expire_time;
	global $session_remember_expire_time;
	
	$session_expire_time = 60 * 60 * 2;//2 hours
	$session_remember_expire_time = 60 * 60 * 24 * 2;//2 days
	$host = $_SERVER['HTTP_HOST'];
	
	if(strpos($_SERVER['SERVER_NAME'], 'etwomensforum.com') !== false)
		$base_url = 'http://' . $host . '/admin/';
	else
		$base_url = 'http://' . $host . '/debates/admin/';
	
	$cUrl = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	
	$happi_admin_loggedin = (isset($_SESSION['happi_admin_loggedin']['id']) && $_SESSION['happi_admin_loggedin']['id'] != '') ? TRUE : FALSE;
	
	if($happi_admin_loggedin)
	{
		$admin_id = $_SESSION['happi_admin_loggedin']['id'];
		
		/* if(!class_exists('Database'))
		{
			require_once 'includes/db.php';
			$db = new Database();
		} */
	}
	include('includes/database.php');
	$error = (isset($_SESSION['error']) && $_SESSION['error'] != '') ? $_SESSION['error'] : '';
	$success = (isset($_SESSION['success']) && $_SESSION['success'] != '') ? $_SESSION['success'] : '';
	$message = (isset($_SESSION['message']) && $_SESSION['message'] != '') ? $_SESSION['message'] : '';
	
	if(isset($_SESSION['error']))
		unset($_SESSION['error']);
	if(isset($_SESSION['success']))
		unset($_SESSION['success']);
	if(isset($_SESSION['message']))
		unset($_SESSION['message']);
	
	if(isset($_GET['rUrl']) && $_GET['rUrl'] != '')
	{
		$rUrl = $_GET['rUrl'];
		$_SESSION['rUrl'] = $rUrl;
	}
	else if(isset($_SESSION['rUrl']) && $_SESSION['rUrl'] != '')
	{
		$rUrl = $_SESSION['rUrl'];
		unset($_SESSION['rUrl']);
	}
	
	if($rUrl != '' && strpos($rUrl,'http://') === false)
	{
		$rUrl = 'http://' . $rUrl;
	}
	
	if(isset($_GET['msg']) && $_GET['msg'] != '')
	{
		if($_GET['msg'] == 'logout')
		{
			$message = 'You are loggedout successfully';
		}
		else if($_GET['msg'] == 'expire')
		{
			$message = 'Your session was expired. Please login again to continue.';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Happi Dashboard</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/admin.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-2.1.0.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/common-script.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>

</head>
<body class="light_theme  fixed_header left_nav_fixed" style="">
		
		<!--------- Start Container ----------->
		
			
