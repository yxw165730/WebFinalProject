<?php 


function getProduct($product_id) {
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql="SELECT * FROM product WHERE product.product_id = '$product_id'";

    $result = mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)) {
        array_push($resultarray,json_encode($array));    
    }
    mysqli_close($con);
    return $resultarray;
}

function getImage($product_id) {
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
    mysqli_close($con);
    return $pic_path;
}


function getCategoryName($category_id){
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT category_name FROM category WHERE category.category_id = '$category_id'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $categoryname = $row["category_name"];
    mysqli_close($con);
    return $categoryname;
}


?>


<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Pizza Management</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="../Admin/css/style.css">
        <link rel="stylesheet" href="../css/style.css">

        <style>
            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */

            .row.content {
                height: 650px
            }
            /* Set gray background color and 100% height */

            .sidenav {
                background-color: #f1f1f1;
                height: 100%;
            }
            /* On small screens, set height to 'auto' for the grid */

            @media screen and (max-width: 767px) {
                .row.content {
                    height: auto;
                }
            }

        </style>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">Pizza Shop Management System</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Management</a></li>
                        <li><a href="../index.php">Main Page</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid contentcontainer">
            <div class="row content">

                <div class="col-sm-12">

                    <div class="row right-content">
                        <h2 class="margin-top-0">Pizza management</h2>
                        <div>

                        </div>

                    </div>
                    <hr>

                    <div class="pr-top modal-header" style="overflow: hidden;">
                        <h4 class="modal-title" style="text-align:center; margin-bottom: 50px;" id="myModalLabel">Update the Product:
                            <?php
                            echo $_GET['p_id'];?>
                        </h4>

                        <div class="pr-top">
                            <?php 
                            $product_id = $_GET['p_id'];
                            $result = getProduct($product_id);
                            $jsontest = json_decode($result[0]);
                            ?>
                        </div>
                        <div class="pr-left" style="margin-top: 10px;">

                            <?php $product_id = $jsontest->{'product_id'} ;
                            $imgpath = "../Admin/" . getImage($product_id);
                            ?>
                            <img src="<?php echo ($imgpath);?>" style="width:200px; height: 100px; margin-right:auto; margin-left:auto; display:block">

                        </div>
                        <div class="pr-right">
                            <p>
                                Category:
                                <?php echo "".getCategoryName($jsontest->{'category_id'} ); ?>
                            </p>

                            <p>
                                Product Name:
                                <?php echo "".$jsontest->{'product_name'} ; ?>
                            </p>
                            <p>
                                Price:
                                <?php echo "".$jsontest->{'price'} ; ?>
                            </p>
                            <p>
                                Stock:
                                <?php echo "".$jsontest->{'stock'} ; ?>
                            </p>
                            <p>
                                Description:
                                <?php echo "".$jsontest->{'description'} ; ?>
                            </p>

                        </div>
                    </div>

                    <div id="modal-content-edit">

                        <div class="modal-body">
                            <form action="handleUpdate.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="bookName-modal">Upload Image:</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="category">Category:</label>
                                    <div class="col-sm-2">
                                        <select name="category" id="category">
                                            <option value="Pizza">Pizza</option>
                                            <option value="Hot Dog">Hot Dog</option>
                                            <option value="Ice Cream">Ice Cream</option>
                                        </select>
                                    </div>

                                    <label class="control-label col-sm-2" for="product_name">Product Name:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="product_name" value="<?php echo $jsontest->{'product_name'};?>">
                                    </div>
                                    <label class="control-label col-sm-2" for="price">Price:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="price" value="<?php echo $jsontest->{'price'};?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="description">Description:</label>
                                    <div class="col-sm-2">
                                        <textarea type="text" class="form-control" name="description" value=""><?php echo $jsontest->{'description'};?></textarea>
                                    </div>
                                    <label class="control-label col-sm-2" for="stock">Stock:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="stock" value="<?php echo $jsontest->{'stock'};?>">
                                    </div>

                                    <label class="control-label col-sm-2" for="product_id">Product ID:</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" readonly="readonly" name="product_id" value="<?php echo $jsontest->{'product_id'};?>">
                                    </div>
                                </div>
                                <div class="pr-top" style="overflow:hidden"><button type="submit" class="btn btn-blue" id='upload_submit' style="float:right">Update</button></div>

                            </form>
                        </div>

                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" id="progress" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                <p id="myprogressp"></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </body>

</html>
