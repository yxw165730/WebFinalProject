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
        <link href="css/meter.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/formValidate.css" rel="stylesheet" type="text/css" media="all" />

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Pizza Order Dinner Fastfood" />
        <script type="application/x-javascript">
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="js/simpleCart.min.js"></script>
        <script src="js/formValidate.js"></script>
        <script src="js/submitValidate.js"></script>
        <script type="text/javascript" src="js/zxcvbn.js"></script>
        <script src="js/password.js"></script>

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
                                <li><a href="checkout.php">
                                    <p style="color: white"> <span class="simpleCart_total" style="color: white"> $0.00 </span> (<span id="simpleCart_quantity" class="simpleCart_quantity">0</span> items)<img src="images/Main/header-cart.png" alt="" style="width:15px; margin-left:10px;"></p>
                                    </a></li>
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
        <!-- register -->
        <div class="main-1">
            <div class="container">
                <div class="register">
                    <form> 
                        <!--                        <form action="submitRegister.php" method="post"> -->
                        <div class="register-top-grid">
                            <h3>PERSONAL INFORMATION</h3>
                            <div class="wow fadeInLeft" data-wow-delay="0.4s" style="display:block">
                                <span>First Name<label>*</label></span>
                                <input type="text" name="firstname" id="firstname"> 
                                <span id='firstname_span'></span>
                            </div>
                            <div class="wow fadeInRight" data-wow-delay="0.4s" style="display:block">
                                <span>Last Name<label>*</label></span>
                                <input type="text" name="lastname" id="lastname"> 
                                <span id='lastname_span'></span>
                            </div>
                            <div class="wow fadeInLeft" data-wow-delay="0.4s" style="display:block">
                                <span>Email Address<label>*</label></span>
                                <input type="text" name="email" id="email">
                                <span id='email_span'></span>
                            </div>
                            
                             <div class="wow fadeInLeft" data-wow-delay="0.4s" style="padding-bottom:30px;">
                                <span style="display:none">Email Address<label>*</label></span>
                                <input type="text" name="email" id="email" style="display:none">
                                <span id='email_span' style="display:none"></span>
                            </div>
                            <div class="clearfix"> </div>
                            <a class="news-letter" href="#">
                               
                            </a>
                        </div>
                        <div class="register-bottom-grid">
                            <h3>LOGIN INFORMATION</h3>
                            <div class="wow fadeInLeft" data-wow-delay="0.4s">
                                <span>Password<label>*</label></span>
                                <input type="password" name="password1" id="password1" autocomplete="off">
                                <span id='password1_span'></span>
                                <meter max="4" id='password-strength-meter'></meter>
                                <p id='password-strength-text'></p>
                            </div>
                            <div class="wow fadeInRight" data-wow-delay="0.4s">
                                <span>Confirm Password<label>*</label></span>
                                <input type="password" name="password2" id="password2" autocomplete="off">
                                <span id='password2_span'></span>
                            </div>
                        </div>
                        <div class="col-md-6 login-right wow fadeInRight" data-wow-delay="0.4s">
                            <input type="button" id="submit" value="submit"  onclick="validate();">
                            <!--                            <input type="submit">-->
                            <div class="clearfix"> </div>
                        </div>
                    </form>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>

        <!-- register -->	
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