<?php
	session_start();
	$arr = $_SESSION['chart'];
	unset($_SESSION['chart']);
	header('Location: orders.php');	
?>