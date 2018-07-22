<?php
session_start();
$arr = $_SESSION['chart'];
$getUserId = $_SESSION['user_id'];
//	$con = mysqli_connect("localhost", "root", "root", "Pizza");
$con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$arr = $_SESSION['chart'];
foreach ($arr as $a) {
    $total_price = $total_price + $a['price'];
    $total_num = $total_num + $a['num'];
}


?>


<!DOCTYPE HTML>
<html>

    <head>
        <title>PizzaKing</title>
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
        <script src="js/simpleCart.min.js">


        </script>
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
                            <li><a href="orders.php">Menu</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li class="active"><a href="history.php">User History</a></li>
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
                <div class="clearfix"> </div>
            </div>
        </div>
        <!-- header -->

        <!-- checkout -->
        <div class="cart-items">
            <div class="container" style="margin-top:100px;">
                <h1>Purchase History : </h1>
                <?php
                $order = mysqli_query($con, "SELECT * FROM `order` WHERE user_id = '" . $getUserId .  "'");
                //echo "hello1";
                while($row = mysqli_fetch_array($order)) {
                    $oid = $row['order_id'];
                    $tPrice = $row['total_price'];
  //                  $userId = $row['user_id'];
 //                   if($userId == $getUserId) {

                ?>
                <div class="cart-header">
                    <div class="cart-sec simpleCart_shelfItem">
                        <div class="cart-item-info">
                            <div>
                                <ul>
                                    <li style="margin-top: 20px; font-size: 16px; list-style: none;">Order id :
                                        <?php echo $oid ?>
                                    </li>
                                    <li style="list-style: none;">Total price :
                                        <?php echo $tPrice ?>
                                    </li>
                                    <?php
                    $orderDetail = mysqli_query($con, "SELECT * FROM `order_detail` WHERE order_id ='" . $oid . "'");
                    while($row1 = mysqli_fetch_array($orderDetail)) {
                        $pid = $row1['product_id'];
                        $pnum = $row1['quantity'];
                        $product = mysqli_query($con, "SELECT product_name FROM `product` WHERE product_id = '" . $pid . "'");
                        $row2 = mysqli_fetch_array($product);
                        $pname = $row2['product_name'];
                                    ?>
                                    <li style="list-style: none;">
                                        <?php 
                        echo $pname . " : ";
                        echo $pnum ?>
                                    </li>
                                    <?php		
//                    }
                                    ?>
                                    <?php
                }
                    ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <?php
                }
                    ?>
                    <br/><br/><br/>
                    <a class="acount-btn" href='index.php'> Return </a>

                </div>
            </div>
        </div>
        <!-- checkout -->

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
