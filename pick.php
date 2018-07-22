<?php
	session_start();

	$pid = $_GET['p_id'];

//$con = mysqli_connect("localhost", "root", "root", "Pizza");
$con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
	if(mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	} else {
//		echo "Database connected successful!";
	}
	$result = mysqli_query($con, "SELECT * FROM product WHERE product_id = '" . $pid . "'");	
	$row = mysqli_fetch_array($result);
	$name = $row['product_name'];
	$price = $row['price'];

	$arr = $_SESSION['chart'];
	if(is_array($arr)) {
		if(array_key_exists($pid, $arr)) {
			$target = $arr[$pid];
			$target['num'] = $target['num'] + 1;
			$target['price'] = $target['price'] + $price;
			$arr[$pid] = $target;
		} else {
			$arr[$pid] = array('pid'=>$pid, 'name'=>$name, 'price'=>$price, 'num'=>1);
		}
	} else {
		$arr[$pid] = array('pid'=>$pid, 'name'=>$name, 'price'=>$price, 'num'=>1);
	}
	$_SESSION['chart'] = $arr;
	header('location:orders.php');
   
	
?>
