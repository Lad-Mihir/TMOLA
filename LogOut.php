<?php 
session_start();
$_SESSION["status"] = false;
$_SESSION["logout_status"] = true;
echo "<Script>alret('sucessfully Logout!!')</script>";
header("Location:SignIn.php");

// $_SESSION["Logout_status"]
// function logout_msg () {
//     echo "sucessfully Logout!!";
// }
?> 