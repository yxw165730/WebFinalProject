<?php
	session_start();

	$pid = $_GET['id'];
	
//	$con = mysqli_connect("localhost", "root", "root", "Pizza");
$con = mysqli_connect("localhost", "root", "root", "Pizza");
	if(mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} 

	$arr = $_SESSION['chart'];
	unset($arr[$pid]);

	$_SESSION['chart'] = $arr;
	header('location: checkout.php');
?>