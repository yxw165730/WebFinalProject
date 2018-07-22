<?php

$q = ($_GET['q']);
$p = ($_GET['p']);

$fliterarray = array();

function numberOfCategory(){
//    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    $sql= "SELECT * FROM category";
    $result = mysqli_query($con,$sql);
    $numberofCategory = mysqli_num_rows($result); 
    mysqli_close($con);
   return $numberofCategory;
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
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
    echo ($categoryname);
    mysqli_close($con);
    return $categoryname;
}


function getProductFromCategory($categoryID,$low,$high) {
    $resultarray = array();
//    $con = mysqli_connect('localhost','root','root','Pizza');
    $con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
    }
    if ($q !== "All" && $p !== "All"){
         $sql="SELECT * FROM Product WHERE `category_id` = '$categoryID' and `price` BETWEEN '$low' AND '$high'AND product.valid = '1'";
    }
    else if($q == "All" && $p !== "All") {
         $sql="SELECT * FROM Product WHERE `price` BETWEEN '$low' AND '$high'AND product.valid = '1'";
    }
    
    else if($q !== "All" && $p == "All") {
        $sql="SELECT * FROM Product WHERE `category_id` = '$categoryID' AND product.valid = '1'";
    }
    $result = mysqli_query($con,$sql);
    while($array = mysqli_fetch_array($result)) {
    array_push($resultarray,json_encode($array));    
}
   mysqli_close($con);
   return $resultarray;
}



//$con = mysqli_connect('localhost','root','root','Pizza');
$con = mysqli_connect('127.0.0.1','root','root','Pizza');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


$result = mysqli_query($con, "SELECT `category_id` FROM Category WHERE `category_name` = '$q'");
while($row = mysqli_fetch_array($result)) {
    $category_id =  $row['category_id'];
}

$low = strtok($p, '-');
$high = get_string_between($p,"-","usd");

?>



    <?php if ($q !== "All" && $p !== "All"): ?>
    <div class="container" style="margin-bottom:50px;">
        <div class="order-top">
            <li class="data">
                <h4>
                    <?php getCategoryName($category_id)?>
                </h4>
                <?php $result = getProductFromCategory($category_id,$low,$high)?>
                <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                <?php $jsontest = json_decode($result[$i]); ?>
                <p>
                    <?php echo "".$jsontest->{'product_name'} ; ?>
                </p>
                <?php endfor; ?>
            </li>
            <li class="data">
                <div class="special-info grid_1 simpleCart_shelfItem">
                    <h4>Price</h4>
                    <?php $result = getProductFromCategory($category_id,$low,$high)?>
                    <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                    <?php $jsontest = json_decode($result[$i]); ?>
                    <div class="pre-top">
                        <div class="pr-left">
                            <div class="item_add"><span class="item_price"><h6> <?php echo "$ ".$jsontest->{'price'}; ?></h6></span></div>
                        </div>
                        <div class="pr-right">
                            <?php 
                            
                             $p_id = $jsontest->{'product_id'};
                                                 echo"<form method='get' action='/WebFinalProject/pick.php'>";
                                                       echo"<input type='hidden' name='p_id' value='$p_id'>";
                                                       echo"<input type='submit' value='pick' style='border:none; background-color:#5fa022; color: #ffffff; float: left; margin-right:10px'>";
                                                    echo"</form>";  ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </li>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php elseif ($q == "All" && $p !== "All"): ?>
    <?php for( $j = 1; $j < numberOfCategory()+1; $j++ ) : ?>
    <div class="container" style="margin-bottom:50px;">
        <div class="order-top">
            <li class="data">
                <h4>
                    <?php getCategoryName($j)?>
                </h4>
                <?php $result = getProductFromCategory($j,$low,$high)?>
                <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                <?php $jsontest = json_decode($result[$i]); ?>
                <p>
                    <?php echo "".$jsontest->{'product_name'} ; ?>
                </p>
                <?php endfor; ?>
            </li>
            <li class="data">
                <div class="special-info grid_1 simpleCart_shelfItem">
                    <h4>Price</h4>
                    <?php $result = getProductFromCategory($j,$low,$high)?>
                    <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                    <?php $jsontest = json_decode($result[$i]); ?>
                    <div class="pre-top">
                        <div class="pr-left">
                            <div class="item_add"><span class="item_price"><h6> <?php echo "$ ".$jsontest->{'price'}; ?></h6></span></div>
                        </div>
                        <div class="pr-right">
                            <?php 
                            
                             $p_id = $jsontest->{'product_id'};
                                                 echo"<form method='get' action='/WebFinalProject/pick.php'>";
                                                       echo"<input type='hidden' name='p_id' value='$p_id'>";
                                                       echo"<input type='submit' value='pick' style='border:none; background-color:#5fa022; color: #ffffff; float: left; margin-right:10px'>";
                                                    echo"</form>";  ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </li>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php endfor; ?>


    <?php elseif ($q !== "All" && $p == "All"): ?>


    <div class="container" style="margin-bottom:50px;">
        <div class="order-top">
            <li class="data">
                <h4>
                    <?php getCategoryName($category_id)?>
                </h4>
                <?php $result = getProductFromCategory($category_id,0,100)?>
                <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                <?php $jsontest = json_decode($result[$i]); ?>
                <p>
                    <?php echo "".$jsontest->{'product_name'} ; ?>
                </p>
                <?php endfor; ?>
            </li>
            <li class="data">
                <div class="special-info grid_1 simpleCart_shelfItem">
                    <h4>Price</h4>
                    <?php $result = getProductFromCategory($category_id,0,100)?>
                    <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                    <?php $jsontest = json_decode($result[$i]); ?>
                    <div class="pre-top">
                        <div class="pr-left">
                            <div class="item_add"><span class="item_price"><h6> <?php echo "$ ".$jsontest->{'price'}; ?></h6></span></div>
                        </div>
                        <div class="pr-right">
                            <?php 
                            
                             $p_id = $jsontest->{'product_id'};
                                                 echo"<form method='get' action='/WebFinalProject/pick.php'>";
                                                       echo"<input type='hidden' name='p_id' value='$p_id'>";
                                                       echo"<input type='submit' value='pick' style='border:none; background-color:#5fa022; color: #ffffff; float: left; margin-right:10px'>";
                                                    echo"</form>";  ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </li>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php else: ?>

    <?php for( $j = 1; $j < numberOfCategory()+1; $j++ ) : ?>
    <div class="container" style="margin-bottom:50px;">
        <div class="order-top">
            <li class="data">
                <h4>
                    <?php getCategoryName($j)?>
                </h4>
                <?php $result = getProductFromCategory($j,0,100)?>
                <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                <?php $jsontest = json_decode($result[$i]); ?>
                <p>
                    <?php echo "".$jsontest->{'product_name'} ; ?>
                </p>
                <?php endfor; ?>
            </li>
            <li class="data">
                <div class="special-info grid_1 simpleCart_shelfItem">
                    <h4>Price</h4>
                    <?php $result = getProductFromCategory($j,0,100)?>
                    <?php for( $i = 0; $i < count($result); $i++ ) : ?>
                    <?php $jsontest = json_decode($result[$i]); ?>
                    <div class="pre-top">
                        <div class="pr-left">
                            <div class="item_add"><span class="item_price"><h6> <?php echo "$ ".$jsontest->{'price'}; ?></h6></span></div>
                        </div>
                        <div class="pr-right">
                            <?php 
                            
                            $p_id = $jsontest->{'product_id'};
                            echo"<form method='get' action='/WebFinalProject/pick.php'>";
                            echo"<input type='hidden' name='p_id' value='$p_id'>";
                            echo"<input type='submit' value='pick' style='border:none; background-color:#5fa022; color: #ffffff; float: left; margin-right:10px'>";
                            echo"</form>";  ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php endfor; ?>
                </div>
            </li>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php endfor; ?>

    <?php endif; ?>
