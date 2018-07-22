<?php
	session_start();
	$arr = $_SESSION['chart'];
//	$orderId = $_SESSION['orderId'];
	$getUserId = $_SESSION['user_id'];
//	$con = mysqli_connect("localhost", "root", "root", "Pizza");
$con = mysqli_connect("localhost", "root", "root", "Pizza");
	if(mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	foreach ($arr as $a) {
		$result = mysqli_query($con, "SELECT stock, product_name, valid FROM product WHERE product_id ='" . $a['pid'] . "'");
		$row = mysqli_fetch_array($result);
		$getStock = $row['stock'];
		$getName = $row['product_name'];
		$updateStock = $getStock - $a['num'];
		$total_price = $total_price + $a['price'];
		$total_num = $total_num + $a['num'];
        $getValid = $row['valid'];
        if($getValid == 0) {
   echo "<script> alert('Sorry, " .$getName. " is not avaliable now!'); window.location.href='checkout.php'; </script>";
      exit();
  }
		if($updateStock < 0) {
//			echo "<script>alert('Sorry, there are not enough '" . $getName . "' in the stock!');</script>";
//			header('Location: checkout.php');
    		echo "<script> alert('Sorry, there are not enough " .$getName. " in the stock!'); window.location.href='checkout.php'; </script>";
    		exit();
		}
		mysqli_query($con, "UPDATE product SET stock='" . $updateStock . "' WHERE product_id ='" . $a['pid'] . "'");
	}

/*	if($orderId) {
		$orderId = $orderId + 1;
	} else {
		$orderId = 1;
	}
	$_SESSION['orderId'] = 	$orderId;*/
/*	$result1 = mysqli_query($con, "SELECT MAX(`order_id`) FROM `order`");
	$row1 = mysqli_fetch_array($result1);
	$orderId = $row1['MAX(`order_id`)'] + 1;*/

	$orderId = time() . "$getUserId";
//	echo time();
//	echo $orderId;
	mysqli_query($con, "INSERT INTO `order`(`order_id`, `total_price`, `user_id`) VALUES ('" . $orderId . "','" . $total_price . "','" . $getUserId . "')");

	foreach ($arr as $a) {
		mysqli_query($con, "INSERT INTO `order_detail`(`order_id`, `product_id`, `quantity`) VALUES ('" . $orderId . "','" . $a['pid'] . "','" . $a['num'] . "')");
	}

	unset($_SESSION['chart']);
	header('Location: orders.php');
	
?>