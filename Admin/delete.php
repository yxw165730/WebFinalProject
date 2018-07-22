<?php 
$product_id = $_GET['p_id'];
//$con = mysqli_connect('localhost','root','root','Pizza');
$con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "UPDATE `product` SET product.valid = '0' WHERE product.product_id = '$product_id'";
    mysqli_query($con,$sql);
    mysqli_close($con);
    header("Location: http://localhost/WebFinalProject/orders.php");
    exit;
?>
