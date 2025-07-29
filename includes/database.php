<?php
 if(strpos($_SERVER['SERVER_NAME'], 'localhost') !== false){
	$servername = "localhost";
	$username = "root";
	$password1 = "";
	$dbname = "happi2";
 }else{
	$servername = "localhost:3306";
	$username = "bn_wordpress";
	$password1 = "751221a133";
	$dbname = "bitnami_wordpress";
	/* $servername = "localhost";
	$username = "corteva_pioneer";
	$password1 = "Pioneer@123";
	$dbname = "corteva_pioneer"; */
 }

// Create connection
$conn = mysqli_connect($servername, $username, $password1, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>