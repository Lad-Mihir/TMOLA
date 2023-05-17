<?php 
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
//   }
// $_SESSION["status"] = false;
// $_SESSION["logout_status"] = true;
// echo "<Script>alret('sucessfully Logout!!')</script>";
// header("Location:signin.php");
// session_destroy();

// // $_SESSION["Logout_status"]
// // function logout_msg () {
// //     echo "sucessfully Logout!!";
// // }

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["status"] = false;
$_SESSION["logout_status"] = true;
session_destroy();
header("Location:signin.php");
echo "<Script>alret('successfully Logout!!')</script>";
?> 