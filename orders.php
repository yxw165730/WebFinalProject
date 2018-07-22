<?php
session_start();

//$con = mysqli_connect("localhost", "root", "root", "Pizza");
$con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$cartarray = array();
$c = 0;

$arr = $_SESSION['chart'];
foreach ($arr as $a) {
    $total_price = $total_price + $a['price'];
    $total_num = $total_num + $a['num'];
}

$result = mysqli_query($con, "SELECT * FROM product");
while($row = mysqli_fetch_assoc($result)) {
    $cartarray = $row;
    $c++;
}
?>

    <?php

function getImage($product_id) {
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
$con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
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


function getProductFromCategory($categoryID) {
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql="SELECT * FROM product INNER JOIN category ON category.category_id = product.category_id WHERE  product.valid = '1' AND category.category_id = '$categoryID'";
    $result = mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)) {
        array_push($resultarray,json_encode($array));    
    }
    mysqli_close($con);
    return $resultarray;
}

function numberOfCategory(){
    //    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT * FROM category";
    $result = mysqli_query($con,$sql);
    $numberofCategory = mysqli_num_rows($result); 
    mysqli_close($con);
    return $numberofCategory;
}

function getCategoryName($category_id){
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT category_name FROM category WHERE category.category_id = '$category_id'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $categoryname = $row["category_name"];
    echo ($categoryname);
    mysqli_close($con);
    return $categoryname;
}

function check_admin_user($email){
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT * FROM `user` WHERE user.email = '$email'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $userstatus = $row["status"];
    mysqli_close($con);
    return $userstatus;
}

?>

        <!DOCTYPE HTML>
        <html>

        <head>
            <title>PizzaKing</title>
            <link rel="stylesheet" type="text/css" href="css/order.css">
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
            <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="keywords" content="Pizza Order Dinner Fastfood" />
            <script type="application/x-javascript">
                addEventListener("load", function() {
                    setTimeout(hideURLbar, 0);
                }, false);

                function hideURLbar() {
                    window.scrollTo(0, 1);
                }

            </script>
            <script src="js/jquery.min.js"></script>
            <script src="js/simpleCart.min.js"></script>
            <script src="js/jPages.js"></script>
        </head>

        <body>
            <!-- header -->
            <div class="header">
                <div class="container">
                    <div class="logo">
                        <a href="index.php" style="float: left"><img src="images/Main/pizzalogo.png" class="img-responsive" alt="" style="height:50px; width: 50px;"></a>
                        <p>Pizza King</p>
                    </div>
                    <div class="header-left">
                        <div class="head-nav">
                            <span class="menu"> </span>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li class="active"><a href="orders.php">Menu</a></li>
                                <li><a href=" contact.php">Contact</a></li>
                                <li>
                                    <?php 
                                if($_SESSION['login']==true)
                                { 
                                    echo '<a href="history.php">User History</a></li>';
                                }
                                else if($_SESSION['login']==false)
                                {
                                    echo '</li>';
                                }
                                ?>
                                    <div class="clearfix"> </div>
                            </ul>
                        </div>
                        <div class="header-right1">
                            <div class="cart box_1">
                                <ul>
                                    <li>
                                        <?php 
                                    if($_SESSION['login']==true)
                                    { 
                                        echo "<p style='color: white'>Hello,".$_SESSION['username']."!</p>";
                                        echo '<a href="logout.php"><span>&nbspLog out</span></a></li>';
                                    }
                                    else if($_SESSION['login']==false)
                                    {
                                        echo '<a href="login.php">Sign In</a></li>';
                                    }
                                    ?>
                                </ul>
                                <ul>
                                    <li>
                                        <a href="checkout.php">
                                            <h3 style="color: white">
                                                <p style="color: white"> $
                                                    <?php 
                                                if($total_price){
                                                    echo " " . $total_price. " ";
                                                } else {echo "0";} 
                                                ?>
                                                </p>
                                                <p style="color: white"> (
                                                    <?php 
                                                if($total_num){
                                                    echo $total_num . " ";
                                                } else {echo "0";} ?> items)</p><img src="images/Main/header-cart.png" alt="" style="width:15px; margin-left:10px;"></h3>
                                        </a>
                                    </li>
                                </ul>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                </div>
            </div>
            <!-- header -->

            
            <!-- about -->
            <script>
                $(function() {
                    $("div.holder").jPages({
                        containerID: "menupages",
                        previous: "←",
                        next: "→",
                        perPage: 1,
                        delay: 20
                    });
                });

            </script>

            <div class="filter container" style="margin-top:130px; margin-bottom: 50px;">
                <form>
                    <div class="filter_component" style="float:left; width:150px;  margin-right: 50px;">
                        <p>Category:</p>
                        <select name="Category" id="category">
                        <option value="All">All</option>
                        <option value="Pizza">Pizzas</option>
                        <option value="Hot Dog">Hot Dogs</option>
                        <option value="Ice Cream">Ice Creams</option>
                    </select>
                    </div>
                    <div class="filter_component" style="float:left; width:150px; margin-right: 50px;">
                        <p>Price:</p>
                        <select name="Price" id="price">
                        <option value="All">All</option>
                        <option value="0-10usd">0-10usd</option>
                        <option value="10-20usd">10-20usd</option>
                        <option value="20-30usd">20-30usd</option>
                    </select>
                    </div>
                    <div class="wow fadeInRight login-right">
                        <input type="button" name="submit" value="Find" onclick="showData();">
                    </div>
                    <!--  <button type="submit" onclick="showUser('2005')">Submit</button>-->

                </form>

            </div>
            <script src="js/showFilter.js"></script>
            <div id="txtHint"></div>

            <div class="orders" style="min-height:550px;overflow:hidden; position:relative; display: block; margin-bottom: 100px;" id="defaultMenu">

                <?php 
            $email = $_SESSION['email'];
            $user_status = check_admin_user($email);                                                          
            if($_SESSION['login']==true && $user_status == 1 ){
                echo "<div id='admin' class='pre-top' style='overflow:hidden; '>";
                echo"<span class='item_price' style='margin-right:10px;'>";
                echo"<a href='../WebFinalProject/Admin/manager.php' style='margin-left:90px;'>";
                echo"+ Add New Product";
                echo "</a>";
                echo "</span>";}?>

                <div class="container" id="menupages" style="overflow:hidden">
                    <?php for( $j = 1; $j < numberOfCategory()+1; $j++ ) : ?>
                    <div class="order-top">
                        <li class="data">
                            <h4>
                                <?php getCategoryName($j)?>
                            </h4>
                            <?php $result = getProductFromCategory($j)?>
                            <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                            <?php $jsontest = json_decode($result[$i]); ?>
                            <div class="pre-top" style="height: 100px;">

                                <div class="pr-left" style="margin:0px!important">
                                    <?php $product_id = $jsontest->{'product_id'} ;
                                $img_path = "../WebFinalProject/Admin/" . getImage($product_id);
                                ?>
                                    <img src="<?php echo ($img_path);?>" style="width:160px; height: 80px;">

                                </div>

                                <div class="pr-right">
                                    <p>
                                        <?php echo "".$jsontest->{'product_name'} ; ?>
                                    </p>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </li>
                        <li class="data">
                            <div class="special-info grid_1 simpleCart_shelfItem">

                                <h4>Price</h4>
                                <?php $result = getProductFromCategory($j)?>
                                <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                                <?php $jsontest = json_decode($result[$i]); ?>
                                <div class="pre-top" style="height: 100px;">
                                    <div class="pr-left">
                                        <div class="item_add" style="padding-top:10px;"><span class="item_price"><h6> <?php echo "$ ".$jsontest->{'price'}; ?></h6></span></div>
                                    </div>
                                    <div class="pr-right">
                                        <div class="item_add">
                                            <?php 
                                        //$_SESSION['product_id'] = $jsontest->{'product_id'};
                                        //echo($_SESSION['product_id']);
                                        $email = $_SESSION['email'];
                                        $user_status = check_admin_user($email);                                                          
                                        if($_SESSION['login']==true && $user_status == 1 ){
                                            $p_id = $jsontest->{'product_id'};
                                            echo "<div id='admin' style='overflow:hidden;'>";
                                            echo"<form method='get' action='/WebFinalProject/Admin/delete.php'>";
                                            echo"<input type='hidden' name='p_id' value='$p_id'>";
                                            echo"<input type='submit' value='delete' style='border:none; background-color:#5fa022; color: #ffffff; float: left; margin-right:10px'>";
                                            echo"</form>";




                                            echo"<form method='get' action='/WebFinalProject/Admin/update.php'>";
                                            echo"<input type='hidden' name='p_id' value='$p_id'>";
                                            echo"<input type='submit' value='update' style='border:none; background-color:#5fa022; color: #ffffff; float: left; margin-right:10px'>";
                                            echo"</form>";


                                            echo "</div>";
                                        }
                                        else{
                                            $pid = $jsontest->{'product_id'};
                                            echo"<form method='get' action='/WebFinalProject/pick.php'>";
                                            echo "<div class='wow fadeInRight login-right'>";
                                            echo"<input type='hidden' name='p_id' value='$pid'>";
                                            echo"<input type='submit' value='pick'>";
                                            echo "</div>";
                                            echo"</form>"; } ?>

                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php endfor; ?>
                            </div>
                        </li>
                        <div class="clearfix"></div>
                    </div>
                    <?php endfor; ?>
                </div>

                <div class="holder" id="#my_page"></div>

            </div>




            <!-- about -->
            <!-- footer-->
            <div class="footer">
                <div class="container">
                    <div class="footer-left">
                        <p>Copyrights © 2017 Group 10 All rights reserved</p>
                    </div>
                    <div class="footer-right">
                        <ul>
                            <li><a href="#"><i class="fbk"></i></a></li>
                            <li><a href="#"><i class="googpl"></i></a></li>
                            <li><a href="#"><i class="link"></i></a></li>
                            <li><a href="#"><i class="rss"></i></a></li>
                            <li><a href="#"><i class="twt"></i></a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- footer-->
        </body>

        </html>
