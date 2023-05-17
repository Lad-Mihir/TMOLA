<?php
// Include configuration file  
require_once 'dbcont.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$Error = [];
$message = [];
$ma = "";
if (isset($_POST['submit'])) {

    $user = $_POST['user'];
    $Email = $_POST['Email'];
    $phone = $_POST['phone'];
    $psw = $_POST['psw'];
    $rpsw = $_POST['psw-repeat'];

    if (!empty($user)) {
        $user = mysqli_real_escape_string($conn, trim($user));
    } else {
        array_push($Error, "Please enter userID.<br>");
    }
    if (!empty($Email)) {
        $password = mysqli_real_escape_string($conn, trim($Email));
    } else {
        array_push($Error, "Please enter Email.<br>");
    }
    if (!empty($phone)) {
        $password = mysqli_real_escape_string($conn, trim($phone));
    } else {
        array_push($Error, "Please enter Email.<br>");
    }

    if (!empty($error)) {
        $message = $error; 
    } else {

        //matching with the database 
        $conn = mysqli_connect(Server, Username, Password, DatabaseName);
        $sql = "SELECT * FROM user_master where userName = '$user' and userEmail = '$Email' and userTelephone= '$phone';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $info = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        $result = mysqli_query($conn, $sql);
// if (!$result) {
//     die('Error: ' . mysqli_error($conn));
// }

// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// if (!$row) {
//     die('Error: ' . mysqli_error($conn));
// }

// $info = mysqli_fetch_assoc($result);
// if (!$info) {
//     die('Error: ' . mysqli_error($conn));
// }

        if ($count == 1) {
            if (!empty($psw)) {
                if ($psw == $rpsw) {
                    $psw = password_hash(mysqli_real_escape_string($conn, trim($psw)), PASSWORD_DEFAULT);
                    $usql = "UPDATE `user_master` set `userPassword`='$psw' where userName = '$user' and userEmail = '$Email' and userTelephone= '$phone';";
                    if (mysqli_query($conn, $usql)) {
                        $ma = 'Password updated sucessful.';
                        header("Location:index.php?m=$ma");
                    } else {
                        $ma = "Error in updating database" . mysqli_error($conn);
                    }
                } else {
                    $ma = "Password is not matcing with repeat password.<br>";
                }
            } else {
                $ma = "Please enter your password.<br>";
            }
        } else {
            $ma = "Provided information are wrong. Please enter correct information.<br>";
        }
    } 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMOLA- SignIn</title>
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
    <div class="hor_ad">
        <img src="Assets/Homepage/9.jpg" style="width:100%; height:200px">
    </div>
    <div class="login">
        <?php
        // $logout_status = $_SESSION["logout_status"];
        // if($logout_status == true) {
        //   // logout_msg();
        //   echo "sucessfully Logout!!";
        // }
        ?>
        <h2>To Change the password fill the following details.</h2>
        <span style="color:red">
            <?php
            if (!empty($message)) {
                foreach ($message as $m) {
                    echo $m;
                }
            }
            echo $ma; ?></span>
            <h4>Want to <a href="signin.php">Sign In?</a> </h4>
        <h4>Do not have acoount yet? Click here for <a href="signup.php">Sign Up</a> </h4>
        <form name="login_form" action="forgetpassword.php" method="POST" class="login_form" onsubmit="validation()">

            <div class="container_SI">

                <label for="user"><b>User Id</b></label>
                <input type="text" placeholder="Enter UserId" name="user" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="Email" required>

                <label for="phone"><b>Phone Number</b><label>
                        <input type="password" placeholder="Enter Phone Number" name="phone" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

                        <button type="submit" class="login_submit" name="submit">Submit</button>
                        <!-- <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> -->
            </div>

            <!-- <div class="container_login" style="background-color:#f1f1f1">
                <a href="forgetpassword.php"><span style="color:red; text-align:center">Forget password?</span></a> -->

                <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
            </div>
        </form>
        <!-- <hr>
        <span style="text-align: center;"><strong>Or</strong></span>
        <a href="admin_login.php"><button class="login_submit" style="font-size:small">Log In as Admin?</button> -->

    </div>
</body>

<script>
    // function validation()  
    // {  
    //     var id=document.login_form.uname.value;  
    //     var ps=document.login_form.psw.value;  
    //     if(id.length=="" && ps.length=="") {  
    //         alert("User Name and Password fields are empty");  
    //         return false;  
    //     }  
    //     else  
    //     {  
    //         if(id.length=="") {  
    //             alert("User Name is empty");  
    //             return false;  
    //         }   
    //         if (ps.length=="") {  
    //         alert("Password field is empty");  
    //         return false;  
    //         }  
    //     }                             
    // }    
</script>
<footer>
    <?php
    include('footer.php');
    ?>
</footer>

</html>

<!-- HTML form for reset password
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
        <span class="help-block">
            <?php echo $email_err; ?>
        </span>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Reset Password">
    </div>
</form> -->