<?php
$email = $_POST["email"];
//$con = mysqli_connect('localhost','root','root','pizza');
$con = mysqli_connect('127.0.0.1','root','root','pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//$email = mysql_real_escape_string($con,$_POST["email"]);
$sql="SELECT `user_id` FROM `user` WHERE `email` = '$email'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
echo $row['user_id'];
mysqli_close($con);
?>