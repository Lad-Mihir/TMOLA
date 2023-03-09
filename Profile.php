<?php 
require("DBcont.php");  
session_start();
$id = $_SESSION['id'];
$UFname = "SELECT userFname FROM user_master where userid = '$id';";
$ULname = "SELECT userLname FROM user_master where userid = '$id';";
$Uemail = "SELECT userEmail FROM user_master where userid = '$id';";
$Uphoneno = "SELECT userTelephone FROM user_master where userid = '$id';";
$Uaddress = "SELECT userAddress FROM user_master where userid = '$id';";
$UState = "SELECT userCity FROM user_master where userid = '$id';";
$UPin = "SELECT userPostalcode FROM user_master where userid = '$id';";

function quritostring($a) {
  $re = mysqli_query($conn, $a);  
      $value = mysqli_fetch_array($re, MYSQLI_ASSOC); 
echo $value;
}
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMOLA- SignIn</title>
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
    <div class="hor_ad">
    <img src="Assets/Homepage/1.jpg" style="width:100%; height:200px">
    </div>
    <div class="login">
    <h2>Persional Information</h2>
    
                
                    First Name:<?php echo $UFname; ?> <br>
                    Last Name: <br>
                    Email: <br>
                    Phone Number: <br>
                    Address: <br>
                    State: <br>
                    Pin Number: <br>
    <a href="Profile_update.php"><button class="button" style="font-size:small">Update your profile</button></a><br><br>
    <a href="LogOut.php"><button class="button"  style="font-size:small">Log Out from your Account</button></a><br><br>
    <a href="Deletaccount.php"><span style="color:red; text-align:right">Delete your Account</span></a>
    </div>
    </body>
<footer>
    <?php
    include('footer.php');
    ?>
</footer>

</html>
