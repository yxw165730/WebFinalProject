<?php
//session_start(); 

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$options = ['cost' => 11,];
$hashedpassword = password_hash($password, PASSWORD_BCRYPT, $options);

// Now insert it (with login or whatever) into your database, use mysqli or pdo!

//$con = mysqli_connect('localhost','root','root','pizza');
$con = mysqli_connect('127.0.0.1','root','root','pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//$username = mysql_real_escape_string($username);
//$email = mysql_real_escape_string($email);
//$password = mysql_real_escape_string($password);
$sql="INSERT INTO `pizza`.`user` (`user_id`, `password`, `user_name`, `email`, `status`) VALUES (NULL, '$hashedpassword', '$username', '$email', '0');";

$result = mysqli_query($con,$sql);// return "1" if seccessed
echo $result;
mysqli_close($con);
?>

