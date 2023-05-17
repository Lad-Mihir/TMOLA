<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["status"] = false;
$_SESSION["logout_status"] = true;
$m="sucessfully Logout as admin!!";
header("Location:signin.php?alert=$m");
session_destroy();

// $_SESSION["Logout_status"]
// function logout_msg () {
//     echo "sucessfully Logout!!";
// }
?> 