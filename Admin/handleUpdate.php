<?php 

function getCategoryID($category_name){
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT category_id FROM category WHERE category.category_name = '$category_name'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $categoryid = $row["category_id"];
    mysqli_close($con);
    return $categoryid;
}

function updateProduct($product_id ,$product_name, $category_name, $price, $description, $stock){
    $category_id = getCategoryID($category_name);
    //$con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "UPDATE `product` SET product_name = '$product_name' , category_id = '$category_id' , price = '$price', description = '$description', stock ='$stock' WHERE product.product_id = '$product_id'";
    mysqli_query($con,$sql);
    mysqli_close($con);
}
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$category = $_POST['category'];
$price = $_POST['price'];
$description = $_POST['description'];
$stock = $_POST['stock'];

//echo($product_id); //echo($product_name); //echo($category); //echo($price); //echo($description); //echo($stock);

if($_FILES["fileToUpload"]["name"] !== ""){
    updateProduct($product_id,$product_name,$category,$price,$description,$stock);
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
        //echo "Sorry, file already exists.";
        //     $con = mysqli_connect('localhost','root','root','Pizza');
        $con = mysqli_connect('127.0.0.1','root','root','Pizza');
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }
        $query = "UPDATE `product_pic` SET product_id = '$product_id', pic_path = '$target_file' WHERE product_pic.product_id = '$product_id'";
        //echo ($query);
        mysqli_query($con,$query);
        header("Location: http://localhost/WebFinalProject/orders.php");
        exit;
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
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
            $query = "UPDATE `product_pic` SET product_id = '$product_id', pic_path = '$target_file' WHERE product_pic.product_id = '$product_id'";
            //         $con = mysqli_connect('localhost','root','root','Pizza');
            $con = mysqli_connect('127.0.0.1','root','root','Pizza');
            if (!$con) {
                die('Could not connect: ' . mysqli_error($con));
            }
            mysqli_query($con,$query);
            //echo ($query);
            header("Location: http://localhost/WebFinalProject/orders.php");
            exit;

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


}
else
{
    updateProduct($product_id,$product_name,$category,$price,$description,$stock);
    header("Location: http://localhost/WebFinalProject/orders.php");
    exit;
}



?>
