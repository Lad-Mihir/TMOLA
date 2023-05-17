<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$Status = false;
if (isset($_SESSION['status'])) {
    // Access the 'status' key
    $Status = $_SESSION['status'];
}

//Search value
$pName = "";
$pDesc = "";
$pRating = "";
$pPrice = "";
$dPrice = "";
/* if (isset($_GET['search'])) {
$pName = $_GET['productName'];
$pDesc = $_GET['productDescription'];
$pRating = $_GET['productRating'];
$pPrice = $_GET['productPrice'];
$dPrice = $_GET['discountPrice'];
header("location:Search.php?a=$pName&b=$pDesc&c=$pRating&d=$pPrice&e=$dPrice");
} */

// if (isset($your_array['userId'])) {
//     // Access the 'userId' key
//     $userId = $your_array['userId'];
// }

if (isset($_POST['searchsubmit'])) {
    $d = $_POST['undersearch'];
    header("Location:filterproductlist.php?d=$d");
}
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="main.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<div class="Header">
    <img src="Assets/Logo.png" alt="Logo" class="Logo">
    <div class="mob_dropdown">
        <button class="dropbtn1" onclick="myFunction3()">Menu</button>
        <div class="mob_dropdown-content" id="Sub_nav3">
            <form class="search" action="filterproductlist.php" method="POST">
                <input type="text" placeholder="Search.." name="undersearch">
                <button type="submit" name="searchsubmit">Go</button>
            </form>
            <button class="dropbtn"><a href="index.php">Home</a></button>
            <button class="dropbtn"><a href="product.php">Product</a></button>

            <button class="dropbtn2" onclick="myFunction()">Support</button>
            <!-- <a href="index.php">Home</a><br>
            <a href="product.php">Product</a><br>
            <a href="">Support</a><br> -->
            <div class="Sub_nav" id="Sub_nav">
                <a href="aboutus.php">About Us</a><br>
                <a href="contactus.php">Contact Us</a><br>
                <a href="tc.php">Terms and Conditions</a><br>
                <a href="privacypolicy.php">Privacy Policy</a><br>
                <a href="returnpolicy.php">Return Policy</a><br>
            </div>
            <?php
            if ($Status == true) { ?>
                <button class='dropbtn2' onclick='myFunction1()'>Profile</button><br>
                <div class='Sub_nav1' id='Sub_nav1'>
                    <a href='profile.php?uid=<?php $userId ?>'>Profile</a><br>
                    <a href='logout.php'>Sign out</a><br>
                </div>
            <?php } else { ?>
                <button class='dropbtn'><a href='signin.php'>Profile</a></button>
            <?php
                // session_destroy();
            } ?>

            <button class="dropbtn"><a href="cart.php">Cart</a></button>
            <!-- <a href="Cart.php">Cart</a> -->
        </div>
    </div>
    <span class="nav_btn">
        <div class="search">
            <form action="filterproductlist.php" method="get">
                <input type="text" placeholder="Search.." name="undersearch">
                <button type="submit" name="searchsubmit">Search</button>
            </form>
        </div>
        <div class="Home">
            <button class="dropbtn"><a href="index.php">Home</a></button>
        </div>
        <div class="Product">
            <button class="dropbtn"><a href="product.php">Product</a></button>
        </div>
        <div class="Support">
            <div class="dropdown">
                <button class="dropbtn">Support</button>
                <div class="dropdown-content">
                    <a href="aboutus.php">About Us</a>
                    <a href="contactus.php">Contact Us</a><br>
                    <a href="tc.php">Terms and Conditions</a><br>
                    <a href="privacypolicy.php">Privacy Policy</a><br>
                    <a href="returnpolicy.php">Return Policy</a>
                </div>
            </div>
        </div>
        <div class="Profile">
            <?php if ($Status == true) { ?>
                <div class="dropdown">
                    <button class="dropbtn">
                        <img src="Assets/Icons/Profile.png" alt="Profile icon" class="Header_icon" height="50px" width="50px">
                    </button>
                    <div class="dropdown-content">
                        <a href='profile.php?u=<?php $userId ?>'>Profile</a><br>
                        <a href='logout.php'>Sign out</a>
                    </div>
                </div>
            <?php } else { ?>
                <button class="dropbtn">
                    <a href="signin.php">
                        <img src="Assets/Icons/Profile.png" alt="Profile icon" class="Header_icon" height="50px" width="50px">
                    </a>
                </button>
            <?php
                // session_destroy();
            } ?>

        </div>
        <div class="Cart">
            <button class="dropbtn"><a href="cart.php">
                    <img src="Assets/Icons/Cart.png" alt="Cart icon" class="Header_icon" height="50px" width="50px">
                </a></button>
        </div>
</div>
</span>

<body>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
</body>
<script>
    function myFunction3() {
        document.getElementById("Sub_nav3").classList.toggle("show3");
    }

    function myFunction() {
        document.getElementById("Sub_nav").classList.toggle("show");
    }

    function myFunction1() {
        document.getElementById("Sub_nav1").classList.toggle("show1");
    }
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>