<?php 
echo("include!");
echo $_SESSION['username'];

function checkadmin($user_name) {
    $resultarray = array();
//    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT * FROM product_pic INNER JOIN product ON product.product_id = product_pic.product_id WHERE product.product_id = '$product_id'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $pic_path = $row["pic_path"];
    return $pic_path;
}



?>
