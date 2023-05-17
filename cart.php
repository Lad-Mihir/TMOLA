<?php
require("dbcont.php");

$userid;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userId'])) {
    $userid = $_SESSION['userId'];
    $ma = "";
    $sql = "SELECT * FROM user_master where userid = '$userid';";
$result = mysqli_query($conn, $sql);
$Pinfo = mysqli_fetch_assoc($result);
} else {
    $ma = "Nothing to show here. Please <a href='SignIn.php'>Sign In</a> to see your orders!!!";
}
if (empty($userid)) {
    $message = "Please <a href='SignIn.php'>Sign In</a> to your account to proceed to checkout.";
}
$product_img;
$product_name;
$product_model;
$product_quantity;
$product_price;
$product_dprice;
$product_total;
$oid = [];
if (!empty($userid)) {
    $sql = "SELECT orderId FROM order_item where paymentStatus='0' and userId='$userid';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        //create an empty array to store the column values
        $id = array();
        //loop through the result set and store the column values in the array
        while ($row = mysqli_fetch_assoc($result)) {
            $oid[] = $row['orderId'];
        }
    }
}
function order_detail($id)
{
    $conn = mysqli_connect(Server, Username, Password, DatabaseName);
    $sql = "SELECT product_master.ProductImages1,product_master.productId, product_master.productName, product_master.productModel, product_master.productPrice, product_master.discountPrice,  order_item.orderTotalpayment, order_item.orderQuantity, order_item.orderId from order_item join product_master on product_master.productId = order_item.productId where orderId=$id;";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }
    $order = mysqli_fetch_assoc($result);
    $product_img = $order['ProductImages1'];
    $product_name = $order['productName'];
    $product_model = $order['productModel'];
    $product_quantity = $order['orderQuantity'];
    $product_price = $order['productPrice'];
    $product_dprice = $order['discountPrice'];
    $product_total = $order['orderTotalpayment'];
    $orderid = $order['orderId'];
    $productId = $order['productId'];
    $order_detail = array($product_img, $product_name, $product_model, $product_quantity, $product_price, $product_dprice, $product_total,$orderid,$productId);
    return $order_detail;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMOLA- Cart</title>
    <link href="main.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="Assets/Favicon.png">
</head>

<body>
    <!-- the header part -->
    <header>
        <?php
        include('header.php');
        ?>
    </header>
    <section class="cart_page">
        <div class="more_info">
            <div class="tab">
                <button class="tablinks" onclick="tabname(event, 'Cartsummary')">Cart Summary</button>
                <button class="tablinks" onclick="tabname(event, 'Checkout')">Checkout</button>
                <button class="tablinks" onclick="tabname(event, 'Address')">Address</button>
                <button class="tablinks" onclick="tabname(event, 'Summary')">Summary</button>
            </div>

            <div id="Cartsummary" class="tabcontent" style="display:block;">

                <p>
                    <a href="index.php"> <span id="cart_button">Continue Shopping</span> </a><br>
                </p>
                <div>
                    <h1>Cart Summary</h1>
                </div>
                <?php 
                if(!empty($ma)) {
                    echo $ma; }?>
                <div>
                    <table style="border:2px; width:100%;">
                        <tr>
                            <th>Product Information</th>
                            <th>Quntity</th>
                            <th>Price$$</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                        <?php
                        foreach ($oid as $id) {
                            $m = order_detail($id);
                        ?>
                            <tr>
                                <td><img src="<?php echo $m[0]; ?>" height="50px" width="50px" />
                                    <label><?php echo $m[1]; ?></label>
                                    <label><?php echo $m[2]; ?></label>
                                </td>
                                <td>
                                    <?php echo $m[3]; ?>
                                </td>
                                <td>
                                    <label>
                                        <?php echo "CAD$ " . number_format($m[4],2); ?>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <?php
                                        if (!empty($m[5])) { 
                                            if($m[5]==0) {
                                                echo "0%";
                                            } else {
                                            $d = floatval($m[4]) - floatval($m[5]);
                                            $dp = number_format((100 * $d) / floatval($m[4]), 2);
                                            echo $dp . "%";
                                            }
                                        } else {
                                            echo "0%";
                                        } ?>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <?php echo "CAD$ " . $m[6]; ?>
                                    </label>
                                </td>
                                <td>
                                    <a href="order_delete.php?id=<?php echo $m[7]; ?>">Remove</a>
                                </td>
                                <td>
                                    <a href="productdetail.php?pid=<?php echo $m[8]; ?>&q=<?php echo $m[3]; ?>">View product</a>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <label>
                                    sub total before tax:
                                    <label>
                            </td>
                            <td>
                                <?php
                                if (!empty($userid)) {
                                    $rsql = "SELECT sum(orderTotalpayment) as orderTotalpayment FROM order_item where paymentStatus='0' and userId='$userid';";
                                    $result = mysqli_query($conn, $rsql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo "CAD$ ".number_format($row['orderTotalpayment'],2);
                                } ?>
                                </label>
                                </label>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <button class="tablinks" onclick="tabname(event, 'Checkout')" id="cart_button">Checkout</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="Checkout" class="tabcontent">
                <h3>Checkout</h3>
                <div>
                    <p>
                        <button class="tablinks" onclick="tabname(event, 'Cartsummary')" id="cart_button" style="background-color: red;">Modify</button><br>
                    </p>
                    <table style="border:2px; width:100%;">
                        <tr>
                            <th>Quntity</th>
                            <th>Product Info</th>
                            <th>Price</th>
                        </tr>
                        <?php
                        foreach ($oid as $id) {
                            $m = order_detail($id);
                        ?>
                            <tr>
                                <td>
                                    <?php echo $m[3] ?>
                                </td>
                                <td>
                                    <label><?php echo $m[1]; ?></label>
                                    <label><?php echo $m[2]; ?></label>
                                </td>
                                <td>
                                    <label>
                                        <?php echo "CAD$ " . number_format($m[6],2); ?>
                                    </label>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <td>
                            </td>
                            <td style="text-align:right;">
                                <label>
                                    <strong>
                                        sub total before tax:
                                    </strong>
                                    <label>
                            </td>
                            <td>
                                <?php
                                if (!empty($userid)) {
                                    $rsql = "SELECT sum(orderTotalpayment) as orderTotalpayment FROM order_item where paymentStatus='0' and userId='$userid';";
                                    $result = mysqli_query($conn, $rsql);
                                    $row = mysqli_fetch_assoc($result);
                                    echo "CAD$ ".$row['orderTotalpayment'];
                                } ?>
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <td>
                            </td>
                            <td style="text-align:right;">
                                <label>
                                    <strong>
                                        Choose your shipping:
                                    </strong>
                                    <label>
                            </td>
                            <td>
                                <?php
                                $taxt_value = floatval($row['orderTotalpayment']) * 0.13;
                               
                            
                                $gtotal = floatval($row['orderTotalpayment']) + floatval($taxt_value);
                                
                                
                                ?>
                                <input type="Radio" id="Free" name="Delivery_option" value="FREE" onchange="myFunction(this.value,'<?php echo $gtotal; ?>')" checked>
                                <label for="Free"> Regular: Free Delivery </label><br>
                                <input type="Radio" id="Fast" name="Delivery_option" value="20" onchange="myFunction(this.value,'<?php echo $gtotal; ?>')">
                                <label for="Fast"> Fast Delivery: $20 </label><br>
                                <input type="Radio" id="Pickup" name="Delivery_option" value="0" onchange="myFunction(this.value,'<?php echo $gtotal; ?>')">
                                <label for="Pickup"> Pick up at store : $0 </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td style="text-align:right;">
                                <label>
                                    <strong>
                                        Estimated shipping charges:
                                    </strong>
                                    <label>
                            </td>
                            <td>
                                
                                CAD$&nbsp;<span id="total">0</span>
                            
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <td>
                            </td>
                            <td style="text-align:right;">
                                <label>
                                    <strong>
                                        TAX:
                                    </strong>
                                    <label>
                            </td>
                            <td>13%<br>
                                <?php
                                echo "CAD$ " . $taxt_value;
                                ?>
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <td>
                            </td>
                            <td style="text-align:right;">
                                <label>
                                    <strong>
                                        Total:
                                    </strong>
                                    <label>
                            </td>
                            <td>
                               CAD$&nbsp;
                                <span id="gtotal"> <?php
                                echo $gtotal;
                                ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                                <button class="tablinks" onclick="tabname(event, 'Address')" id="cart_button">Choose your Address</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <h5></h5>

                </div>
            </div>
            <div id="Address" class="tabcontent">
                <h3>Select your Address</h3>
                
                    <table>
                        <tr>
                            <td>
                <input type="radio" id="add_radio" checked>
                <label for="add_radio"> 
                    <strong><?php echo $Pinfo['userFname']." ". $Pinfo['userLname']; ?></strong></span><br>
                    <span style="margin-left: 30px;"><strong> Phone No:</strong><?php echo $Pinfo['userTelephone']; ?></span><br>
                    <span style="margin-left: 30px;"><strong> Email:</strong><?php echo $Pinfo['userEmail']; ?><br>
                    <address style="margin-left: 30px;">
                    <strong>Address:</strong>
                        <?php echo $Pinfo['userAddress']; ?><br>
                        <span style="margin-left: 80px;"><?php echo $Pinfo['userCity']; ?></span><br>
                        <span style="margin-left: 80px;"><?php echo $Pinfo['userPostalcode']; ?></span><br>
                    </address>
                </label><br><br>
                            </td>
                            <td></td>
                            </tr>
                            <tr><td>
                <a href="Profile.php" style="text-decoration: none;"><strong>Modify your address</strong></a> 
                            </td>
                            <td>
            <button class="tablinks" id="cart_button"  onclick="tabname(event, 'Summary')">Summary</button>
                            </td>
                            </tr>
                    </table>
                          
                            </div>
            <div id="Summary" class="tabcontent">
                <h3>Order Summary</h3>
                <form action="Cart.php" method="POST">
                    <p>
                        <a href="index.php"> <span id="cart_button">Continue Shopping</span> </a><br>
                    </p>
                    <div>
                        <h3> Billing Information: </h3>
                    <table>
                        <tr style="background-color:white;">
                            <th style="text-align:right;">
                            Name:
                            </th>
                            <td>
                            <?php echo $Pinfo['userFname']." ". $Pinfo['userLname']; ?>
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <th style="text-align:right;">
                            Phone No:
                            </th>
                            <td>
                            <?php echo $Pinfo['userTelephone']; ?>
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <th style="text-align:right;">
                            Email:
                            </th>
                            <td>
                            <?php echo $Pinfo['userEmail']; ?>
                            </td>
                        </tr>
                        <tr style="background-color:white;">
                            <th style="text-align:right;  vertical-align: top;">
                            Address:
                            </th>
                            <td>
                            <?php echo $Pinfo['userAddress']; ?><br>
                       <?php echo $Pinfo['userCity']; ?><br>
                        <?php echo $Pinfo['userPostalcode']; ?><br>
                            </td>
                        </tr>
                    </table>
                    
                    </div>
                    <hr>
                    <h3> order summary: </h3>
                    <div>
                    <table style="border:2px; width:100%;">
                        <tr>
                            <th>Quntity</th>
                            <th>Product Info</th>
                            <th>Price</th>
                        </tr>
                        <?php
                        foreach ($oid as $id) {
                            $m = order_detail($id);
                        ?>
                            <tr>
                                <td>
                                    <?php echo $m[3] ?>
                                </td>
                                <td>
                                    <label><?php echo $m[1]; ?></label>
                                    <label><?php echo $m[2]; ?></label>
                                </td>
                                <td>
                                    <label>
                                        <?php echo "CAD$ " . $m[6]; ?>
                                    </label>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <td>
                            </td>
                            <td style="text-align:right;">
                                <label>
                                    <strong>
                                        total after tax:
                                    </strong>
                                    <label>
                            </td>
                            <td>
                            CAD$&nbsp;
                                <span id="gtotal"> <?php
                                echo $gtotal;
                                ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td >
                                
                            </td>
                            <td>
                            <button class="tablinks" onclick="tabname(event, 'Thankyou')" id="cart_button">Place order</button>
                            </td>
                        </tr>
                        
                        
                    </table>
                    </div>

                </form>
                
            </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet"
href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        function tabname(evt, tabname) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabname).style.display = "block";
            evt.currentTarget.className += " active";
        }
        var data = 0;

        //printing default value of data that is 0 in h2 tag
        document.getElementById("counting").innerText = data;

        //creation of increment function
        function increment() {
            data = data + 1;
            document.getElementById("counting").innerText = data;
        }
        //creation of decrement function
        function decrement() {
            data = data - 1;
            document.getElementById("counting").innerText = data;
        }

        // For the Delivery Option 
        function myFunction(deliveryOption,gtotal) {
           debugger;
            var shipping_charge = 0;
            if (deliveryOption === "FREE") {
                shipping_charge = 0;
            } else if (deliveryOption === "20") {
                shipping_charge = 20;
            } else if (deliveryOption === "0") {
                shipping_charge = 0;
            }
            document.getElementById("total").innerHTML = shipping_charge.toFixed(2);
            document.getElementById("gtotal").innerHTML = (parseFloat(gtotal)+shipping_charge).toFixed(2);
        }

        //
        // $(document).ready(function() {
        //     var a = <?php echo $gtotal; ?>;
        //     var b = parseInt($("#total").text());
        //     var c = a + b;
        //     $("#gtotal").text(c);
        // });
//         $(document).ready(function () {
//       var v = <?php echo $gtotal; ?>;
//       var b = parseInt($("#total")
//       .text()
//       .trim()
//       .replace(',', ''));
//       var totalValue = v + b;
//       console.log(totalValue);
//       $("#gtotal").text("After multiplying the Value 10=" + totalValue);
//    });
    </script>
</body>
<footer>
    <?php
    include('footer.php');
    ?>
</footer>

</html>