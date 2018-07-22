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
                        <li ><a href="index.php">Home</a></li>
                        <li><a href="orders.php">Menu</a></li>
                        <li class="active"><a href=" contact.php">Contact</a></li>
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
    <!-- contact -->
    <div class="contact">
        <div class="container" style="margin-top: 100px; margin-bottom:50px;">
            <div class="contact-head">
                <h3>CONTACT US</h3>
            </div>
            <div class="contact-grid">
                <form action="contactform.php" method="post">
                    <input type="text" placeholder="Firstname" name="contact_first_name" required/>
                    <input type="text" placeholder="Lastname" name="contact_last_name" required/>
                    <input type="text" placeholder="Phone number" name="contact_phone" required/>
                    <input type="text" placeholder="E-mail" name="contact_email" required/>
                    <textarea placeholder="Message" name="contact_message" required></textarea>
                    <input type="submit" value="SEND" />
                </form>
            </div>
            <div class="contact-details">
                <div class="col-md-6 contact-map">
                    <h4>FIND US HERE</h4>
                    <iframe width="6400" height="250" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJpUpeif8hTIYRMROq6TKLCdk&key=AIzaSyBUFlKW3oywX_1fJrfFPt89ks8ZnM7DpeE" allowfullscreen></iframe>
                </div>
                <div class="col-md-6 company_address">
                    <h4>ADDRESS</h4>
                    <p>800 W Campbell Rd</p>
                    <p>Richardson, TX 75080</p>
                    <p>USA</p>
                    <p>Phone:(425) 444 3459</p>
                    <p>Email:xxz155330@utdallas.edu</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <!-- contact -->
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
