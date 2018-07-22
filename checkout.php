<?php
 session_start();
 $arr = $_SESSION['chart'];
// $con = mysqli_connect("localhost", "root", "root", "Pizza");
$con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
 if(mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }

 foreach ($arr as $a) {
  $total_price = $total_price + $a['price'];
  $total_num = $total_num + $a['num'];
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



function getProduct($p_ID) {
    $resultarray = array();
//    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect("127.0.0.1", "root", "root", "Pizza");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $sql="SELECT * FROM product WHERE product_id = '$p_ID'";
    
    $result = mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)) {
    array_push($resultarray,json_encode($array));    
}
   mysqli_close($con);
   return $resultarray;
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
        addEventListener("load", function () {
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
 
 <!-- checkout -->
<div class="cart-items">
<div class="" style="margin-top:50px;">
    <div class="container">
 <h1>My Shopping Bag <a href="clearChart.php" class="simpleCart_empty">Empty Cart</a></h1>
 <?php
  foreach($arr as $a) {
 ?>
 <div class="cart-header">
  <div class="close" style="margin-top:50px; margin-right:50px;"><a href='removeItem.php?id=<?php echo $a['pid'] ?>'><img src="images/close_1.png" alt=""></a></div>
  <div class="cart-sec simpleCart_shelfItem">
   <div class="cart-item cyc">
        <?php $result = getProduct($a['pid']);
      ?>                    
        <?php $jsontest = json_decode($result[0]); ?>
    <div class="pr-left" style="margin:0px!important">
                                    <?php $product_id = $jsontest->{'product_id'} ;
                                          $img_path = "../WebFinalProject/Admin/" . getImage($product_id);
                                    ?>
                                    <img src="<?php echo ($img_path);?>" style="width:200px; height: 100px; margin-top: 30px;">

  </div>
   </div>
      <div class="pr-right">
   <div class="cart-item-info">
                <h3><a href="#"><?php echo $a['name'] ?> </a></h3>
    <div class="delivery"> 
     <p>Service Charges : <?php echo $a['price'] ?> </p><br/>
     <p>Quantity : <?php echo $a['num'] ?> </p><br/>
     <div class="clearfix"></div>
    </div> 
   </div>
     </div>
      
      
      
   <div class="clearfix"> </div>    
  </div>
  <?php echo "<br/>";}?>
  <a class="acount-btn" href='returnzero.php'>Check Out</a><br/><br/>
  <div class="clearfix"> </div> 
  <a class="acount-btn" href='orders.php'>Return to order page</a> 
 </div>
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