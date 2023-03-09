<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- Cart</title>
  <link href="Main.css" rel="stylesheet">
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
            <form action="#Checkout" method="POST">
                <p>
                    <a href="index.php"> <span id="cart_button">Continue Shopping</span> </a><br>
                </p>
                <div>
                    <h1>Cart Summary</h1>
                </div>
                <div>
                    <table style="border:2px; width:100%;">
                        <tr>
                            <th>Product Information</th>
                            <th>Quntity</th>
                            <th>Price$$</th>
                            <th>Discount</th>
                            <th>Total</th>

                        </tr>
                        <tr>
                            <td><img src="Assets/Homepage/6.jpg" height="50px" width="50px" />
                                <label>Product Name</label>
                                <label>Product info</label>
                            </td>
                            <td>
                                <div class="container">
                                    <!-- adding button and heading to show the digits -->
                                    <!-- increment() and decrement() functions on button click-->
                                    <button onclick="decrement()" class="pro_cont_btn_de">-</button>
                                    <span id="counting"></span>
                                    <button onclick="increment()" class="pro_cont_btn_in">+</button>
                                </div>

                            </td>
                            <td>
                                <label>
                                    $3000
                                </label>
                            </td>
                            <td>
                                <label>
                                    15%
                                </label>
                            </td>
                            <td>
                                <label>
                                    $2800
                                </label>
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
                                <label>
                                    sub total before tax:
                                    <label>
                                        $2800
                                    </label>
                                </label>
                            </td>
                        </tr>

                    </table>    
                </div>
                <button class="tablinks" onclick="tabname(event, 'Checkout')" id="cart_button">Checkout</button>
            </form>
        </div>

        <div id="Checkout" class="tabcontent">
            <h3>Features</h3>
            <table style="border:2px; width:100%;">
                <tr>
                    <th>Product Information</th>
                    <th>Quntity</th>
                    <th>Price$$</th>
                    <th>Discount</th>
                    <th>Total</th>

                </tr>
                <tr>
                    <td><img src="Assets/Homepage/6.jpg" height="50px" width="50px" />
                        <label>Product Name</label>
                        <label>Product info</label>
                    </td>
                    <td> <label>
                            Quntity
                        </label>
                        <select name="quantity" id="cartQuantity">
                            <option>1</option>
                        </select>

                    </td>
                    <td>
                        <label>
                            $3000
                        </label>
                    </td>
                    <td>
                        <label>
                            15%
                        </label>
                    </td>
                    <td>
                        <label>
                            $2800
                        </label>
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
                        <label>
                            sub total before tax:
                            <label>
                                $2800
                            </label>
                        </label>
                    </td>
                </tr>

            </table>
            <button class="tablinks" onclick="tabname(event, 'Address')" id="cart_button">Address</button>
        </div>





        <div id="Address" class="tabcontent">
            <h3>Select your Address</h3>
            <input type="radio" id="add_radio">
            <label for="add_radio">

                <strong>Mihir Lad</strong><br>
                <address style="margin-left: 30px;">
                    200 waterbrook lane,<br>
                    Kitchener, ON.<br>
                    Canada. N2P 0H7.
                </address>
            </label><br><br>
            <a href="Profile.php" style="text-decoration: none;"><strong>Modify your address</strong></a>
        </div>
        <div id="Summary" class="tabcontent">
            <h3>Order Summary</h3>
            <form action="Cart.php" method="POST">
                <p>
                    <a href="index.php"> <span id="cart_button">Continue Shopping</span> </a><br>
                </p>
                <div>
                    Summary
                </div>

            </form>
            <button class="tablinks" onclick="tabname(event, 'Thankyou')" id="cart_button">Place order</button>
        </div>

</section>
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
</script>
</body>
<footer>
<?php
  include('footer.php');
  ?>
</footer>
</html>