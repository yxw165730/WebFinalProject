<?php

function create_folder($dir)
{
	if (!is_dir($dir)) {
		$old = umask(0);
		mkdir($dir, 0777);
		umask($old);
	}
}

function deleteDirectory($dir) { 
	if (!file_exists($dir)) { return true; }
	if (!is_dir($dir) || is_link($dir)) {
		return unlink($dir);
	}
	foreach (scandir($dir) as $item) { 
		if ($item == '.' || $item == '..') { continue; }
		if (!deleteDirectory($dir . "/" . $item, false)) { 
			chmod($dir . "/" . $item, 0777); 
			if (!deleteDirectory($dir . "/" . $item, false)) return false; 
		}; 
	} 
	return rmdir($dir); 
}


function getCategoryID($category_name){
    $resultarray = array();
//    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT category_ID FROM category WHERE category.category_name = '$category_name'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $categoryid = $row["category_ID"];
    return $categoryid;
}


function getProductID($product_name){
    $resultarray = array();
//    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT `product_id` FROM `product` WHERE `product_name` = '$product_name'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row["product_id"];
    return $id;
}


date_default_timezone_set('America/Chicago');


$usage = $_POST['add'];;

$product_name = $_POST['product_name'];
$category = $_POST['category'];
$price = $_POST['price'];
$description = $_POST['description'];
$stock = $_POST['stock'];
$category_id = getCategoryID($category);

echo($usage);



$uploadTime = date("Y-m-d H:i:s");

//    $con = mysqli_connect('localhost','root','root','Pizza');
$con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $query = "INSERT INTO `product` (`product_id`, `price`, `category_id`, `product_name`, `stock`, `description`) VALUES (NULL, '$price', '$category_id', '$product_name', '$stock', '$description  ')";
    mysqli_query($con,$query);
    
    $product_id = getProductID($product_name);
    


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $query = "INSERT INTO `product_pic`(`pic_path`, `product_id`) VALUES ('$target_file','$product_id')";
        mysqli_query($con,$query);
        header("Location: http://localhost/WebFinalProject/orders.php");
        exit;
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        $query = "INSERT INTO `product_pic`(`pic_path`, `product_id`) VALUES ('$target_file','$product_id')";
        mysqli_query($con,$query);
        header("Location: http://localhost/WebFinalProject/orders.php");
        exit;

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>
