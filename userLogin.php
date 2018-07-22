<?php
session_start();

$email = $_POST["login_email"];
$password = $_POST["login_password"];
if (empty($email))
{
    echo "<script>alert('Please enter your email.'); window.location.href='login.php'; </script>";
}
if (empty($password))
{
    echo "<script> alert('Please enter your password.'); window.location.href='login.php'; </script>";
}

//$con=mysqli_connect('localhost', 'root', 'root','pizza');
$con=mysqli_connect('127.0.0.1', 'root', 'root','pizza');
if (!$con)
{
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
$query = "SELECT `user_id`, `password`, `user_name` FROM `user` WHERE `email` LIKE '$email'";
$result = mysqli_query ($con,$query);
$row = mysqli_fetch_array($result);
$dbuserid = $row['user_id'];
$dbpassword = $row['password'];
$dbusername = $row['user_name'];
//echo $row['password'];
//echo nl2br ("\n");
//echo strlen($row['password']);
//echo nl2br ("\n");
if(strlen($dbpassword) == 0)
{
    echo "<script>alert('The email does not exist, please sign up first.'); window.location.href='register.php'; </script>";
} else {
    //    echo $password;
    //    echo nl2br ("\n");
    //    echo $row['password'];
    //    echo nl2br ("\n");
    //    password_verify($password, $row['password']);
    if (password_verify($password, $dbpassword)) {
        session_regenerate_id(); //recommended since the user session is now authenticated
        $_SESSION['user_id']=$dbuserid;
        $_SESSION['username']=$dbusername;
        $_SESSION['email']=$email;
        $_SESSION['login']=true;
        ;
    echo '<script>alert("Welcome back, '.$dbusername.'."); window.location.href="index.php"; </script>';
    } else {
        echo "<script>alert('Your password is incorrect.'); window.location.href='login.php'; </script>";
    }
}

mysqli_close($con);
?>