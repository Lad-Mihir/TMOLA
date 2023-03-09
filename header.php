<?php 
session_start();
$Status = $_SESSION['status'];
?> 
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="Main.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<div class="Header">
    <img src="Assets/Logo.png" alt="Logo" class="Logo">
    <div class="mob_dropdown">
        <button class="dropbtn1" onclick="myFunction3()">Menu</button>
        <div class="mob_dropdown-content" id="Sub_nav3">
            <form class="search" action="">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit">Go</button>
            </form>
            <button class="dropbtn"><a href="index.php">Home</a></button>
            <button class="dropbtn"><a href="product.php">Product</a></button>
            
            <button class="dropbtn2" onclick="myFunction()">Support</button>
            <!-- <a href="index.php">Home</a><br>
            <a href="product.php">Product</a><br>
            <a href="">Support</a><br> -->
            <div class="Sub_nav" id="Sub_nav">
                <a href="AboutUs.php">About Us</a><br>
                <a href="ContactUs.php">Contact Us</a><br>
                <a href="TC.php">Terms and Conditions</a><br>
                <a href="PrivacyPolicy.php">Privacy Policy</a><br>
                <a href="ReturnPolicy.php">Return Policy</a><br>
            </div>
            <?php 
            if ($Status== true) {?>
                <button class='dropbtn2' onclick='myFunction1()'>Profile</button><br>
            <div class='Sub_nav1' id='Sub_nav1'>
                <a href='Profile.php'>Profile</a><br>
                <a href='LogOut.php'>Sign out</a><br> 
            </div>
            <?php }
            else {?>
                <button class='dropbtn'><a href='SignIn.php'>Profile</a></button>
            <?php 
            // session_destroy();
        }?>
            <!-- <button class="dropbtn"><a href="SignIn.php">Profile</a></button> -->
            <!-- <button class="dropbtn2" onclick="myFunction1()">Profile</button><br>
            <a href="">Profile</a><br>
            <div class="Sub_nav1" id="Sub_nav1">
                <a href="SignIn.php">Sign In</a><br>
                <a href="SignUp.php">Sign Up</a><br>
                <a href="Profile.php">Profile</a><br>
                <a href="SignOut.php">Sign Out</a><br>
            </div> -->
            <button class="dropbtn"><a href="Cart.php">Cart</a></button>
            <!-- <a href="Cart.php">Cart</a> -->
        </div>
    </div>
    <span class="nav_btn">
        <div class="search">
            <input type="text" height="70px" width="50px" class="search_input" name="search_input">
            <button class="searchbtn" for="Search_input" value="Search">Search</button>
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
                    <a href="AboutUs.php">About Us</a>
                    <a href="ContactUs.php">Contact Us</a><br>
                    <a href="TC.php">Terms and Conditions</a><br>
                    <a href="PrivacyPolicy.php">Privacy Policy</a><br>
                    <a href="ReturnPolicy.php">Return Policy</a>
                </div>
            </div>
        </div>
        <div class="Profile">
        <?php if ($Status== true) {?>
            <div class="dropdown">
            <button class="dropbtn">
                    <img src="Assets/Icons/Profile.png" alt="Profile icon" class="Header_icon" height="50px" width="50px">
                </button>
            <div class="dropdown-content">
                <a href='Profile.php'>Profile</a><br>
                <a href='LogOut.php'>Sign out</a><br> 
            </div>
            </div>
            <?php }
            else {?>
                <button class="dropbtn">
                <a href="SignIn.php">
                    <img src="Assets/Icons/Profile.png" alt="Profile icon" class="Header_icon" height="50px" width="50px">
                    </a>
                </button>
            <?php 
            // session_destroy();
        }?>
            <!-- <div class="dropdown"> -->
                <!-- <button class="dropbtn">
                <a href="SignIn.php">
                    <img src="Assets/Icons/Profile.png" alt="Profile icon" class="Header_icon" height="50px" width="50px">
                    </a>
                </button> -->
                <!--
                <div class="dropdown-content">
                    <a href="SignIn.php">Sign In</a>
                    <a href="SignUp.php">Sign Up</a>
                    <a href="Profile.php">Profile</a>
                    <a href="SignOut.php">Sign Out</a>
                </div>
            </div> -->
        </div>
        <div class="Cart">
            <button class="dropbtn"><a href="Cart.php">
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