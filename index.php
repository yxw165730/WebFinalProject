<!--
Author: XiaomengZhang, Yanwang, YunZhou
-->
<?php
session_start();
$arr = $_SESSION['chart'];
foreach ($arr as $a) {
	$total_price = $total_price + $a['price'];
	$total_num = $total_num + $a['num'];
}





function getProduct() {
    $resultarray = array();
//    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $sql="SELECT * FROM product WHERE  product.special = '1' AND product.valid = '1'";
    
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
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="orders.php">Menu</a></li>
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
                <div class="clearfix"> </div>
            </div>
        </div>
        <!-- header -->
        <!-- banner -->
        <script src="js/search.js"></script>
        <div class="banner">
            <div class="container">
                <div class="b_room">
                    <div class="booking_room">
                        <br />
                        <div class="reservation">

                            <ul>
                                <li class="span1_of_1">
                                    <!----------start section_room---------- -->
                                    <form action="searchorders.php" method="get">
                                        <input type="text" class="textbox" value="Pizza Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'All';}" id="search_item" name="searchValue">

                                        <li class="span1_of_3">
                                            <div class="date_btn">
                                                <input type="submit" value="Find My Pizza" style="background-color: #D96B66; border:none; border-radius: 3px; padding: 10px 6px 6px 10px; color:white">
                                            </div>
                                        </li>
                                    </form>
                                </li>

                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner -->
        <!-- latis -->
        <div class="latis">
            <div class="container" style="margin-bottom:20px">




                <?php for( $i = 0; $i < count(getProduct()); $i++ ) : ?>
                <?php $result = getProduct();?>
                <?php $jsontest = json_decode($result[$i]); ?>
                <div class="col-md-4 latis-left" style="margin-bottom:40px!important">
                    <h3>
                        <?php echo $jsontest->{'product_name'}  ; ?>
                    </h3>

                    <div class="img-responsive">
                        <?php $product_id = $jsontest->{'product_id'} ;
                                          $img_path = "../WebFinalProject/Admin/" . getImage($product_id);
                                    ?>
                        <img class="img-responsive" src="<?php echo ($img_path);?>" style="height:159px; width: 283px;">

                    </div>
                    <div class="special-info grid_1 simpleCart_shelfItem">
                        <p>
                            <?php echo $jsontest->{'description'}  ; ?>
                        </p>
                        <div class="cur">
                            <div class="cur-left">
                                <div class="item_add">

                                    <?php 
                                $pid = $jsontest->{'product_id'};
                                echo"<form method='get' action='/WebFinalProject/pick.php'>";
                                     echo "<div class='wow fadeInRight login-right'>";
                                                       echo"<input type='hidden' name='p_id' value='$pid'>";
                                                       echo"<input type='submit' value='Add To Cart'>";
                                     echo "</div>";
                                echo"</form>";
                                ?>

                                </div>
                            </div>
                            <div class="cur-right">
                                <div class="item_add"><span class="item_price"><h6><?php  echo "$ ".$jsontest->{'price'}  ; ?></h6></span></div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>

                <div class="clearfix"> </div>


            </div>
        </div>
        <!-- latis -->



        <!-- magnust -->

        <!-- magnust -->
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
