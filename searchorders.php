<?php 
$searchValue = $_GET["searchValue"]; 

?>

<?php
session_start();
//$con = mysqli_connect("localhost", "root", "root", "Pizza");
$con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
if(mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    //	echo "Database connected successful!";
}
$array = array();
$c = 0;

$arr = $_SESSION['chart'];
foreach ($arr as $a) {
    $total_price = $total_price + $a['price'];
    $total_num = $total_num + $a['num'];
}

$result = mysqli_query($con, "SELECT * FROM product");
while($row = mysqli_fetch_assoc($result)) {
    $array[] = $row;
    $c++;
}

?>

    <?php

function getProductFromCategory($searchValue) {
    $resultarray = array();
    //    $con = mysqli_connect('localhost','root','root','Pizza');
$con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    
    if ($searchValue == "Pizza Name"){
        $searchValue = "All";
         $sql="SELECT * FROM product WHERE product.valid = '1'";
        $result = mysqli_query($con,$sql);
        while($array = mysqli_fetch_array($result)) {
            array_push($resultarray,json_encode($array));    
        }
 
    }
    
    else{
         $sql="SELECT * FROM product INNER JOIN category ON category.category_id = product.category_id WHERE category.category_name =   '$searchValue' AND product.valid = '1'";
    $result = mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)) {
        array_push($resultarray,json_encode($array));}
    if(count($resultarray) == 0){
        $sql="SELECT * FROM product WHERE `product_name` = '$searchValue' AND product.valid = '1'";
        $result = mysqli_query($con,$sql);
        while($array = mysqli_fetch_array($result)) {
            array_push($resultarray,json_encode($array));    
        }
    }
    if(count($resultarray) == 0){
        echo("no results");
    }
        
        
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

?>


        <?php
session_start();
?>
        <!DOCTYPE HTML>
        <html>

        <head>
            <title>PizzaKing</title>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
            <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
            <link href="css/order.css" rel="stylesheet" type="text/css" media="all" />
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
                    <div class="clearfix"> </div>
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

            <div class="container" style="margin-top:100px; margin-bottom: 100px;">
                <div class="order-top">
                    <li class="data">
                        <h4>
                            Here is the results for:
                            <?php
                            if ($searchValue == "Pizza Name"){
                                echo "All";
                            }
                            else{
                                 echo ($searchValue);
                                }

?>
                        </h4>
                        <?php $result = getProductFromCategory($searchValue)?>
                        <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                        <?php $jsontest = json_decode($result[$i]); ?>
                        <p style="height:43px">
                            <?php echo "".$jsontest->{'product_name'} ; ?>
                        </p>
                        <?php endfor; ?>
                    </li>
                    <li class="data">
                        <div class="special-info grid_1 simpleCart_shelfItem">
                            <h4>Price</h4>
                            <?php $result = getProductFromCategory($searchValue)?>
                            <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                            <?php $jsontest = json_decode($result[$i]); ?>
                            <div class="pre-top">
                                <div class="pr-left">
                                    <div class="item_add"><span class="item_price"><h6> <?php echo "$ ".$jsontest->{'price'}; ?></h6></span></div>
                                </div>
                                <div class="pr-right">
                                    <?php 
                                $pid = $jsontest->{'product_id'};
                                echo"<form method='get' action='/WebFinalProject/pick.php'>";
                                echo "<div class='wow fadeInRight login-right'>";
                                echo"<input type='hidden' name='p_id' value='$pid'>";
                                echo"<input type='submit' value='pick'>";
                                echo "</div>";
                                echo"</form>"; 
                                ?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </li>
                    <div class="clearfix"></div>
                </div>
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
