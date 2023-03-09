<?php      
    require("DBcont.php");  
    //Blank array for storing the Errors.
    $logout_status;
$Error = [];
    if(isset($_POST['submit'])) {

    $username = $_POST['uname'];  
    $password = $_POST['psw'];  

          if(!empty($username)){
            $username = mysqli_real_escape_string($conn, trim($username));
          } else {
            array_push($Error, "Please enter userID.<br>");
          }
          if (!empty($password)) {
            $password = mysqli_real_escape_string($conn, trim($password));
        } else {
          array_push($Error, "Please enter password.<br>");
        }
//displaying Eroor if there is any other wise redirecting to sucess page.
if (!empty($Error)) {
  foreach ($Error as $error) {
    echo $error;
  }
}
      //matching with the database 
      $sql = "SELECT * FROM user_master where userName = '$username' and userPassword = '$password';";  
      $result = mysqli_query($conn, $sql);  
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
      $count = mysqli_num_rows($result);
      $Fname = "SELECT * FROM user_master where userName = '$username';";
      $id = "SELECT userId FROM user_master where userName = '$username';";
          session_start();
          $_SESSION['Fname'] = $Fname;
          $_SESSION['status'] = false;
          $_SESSION['id'] = $id;
      if($count == 1){  
         $_SESSION['status'] = true;
          header("Location:index.php");
          echo "Login sucessfull!"; 
      }  
      else{  

          // array_push($Error, "Login Fail! Please check your credentials.<br>");
          echo "Login Fail! Please check your credentials."; 
          // foreach ($Error as $error) {
          //     // echo "<script>alert('ohh! Error in signup. Please try again.');<script>";
          //     echo $error; 
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
    <?php 
    $logout_status = $_SESSION["logout_status"];
    if($logout_status == true) {
      // logout_msg();
      echo "sucessfully Logout!!";
    }
    ?>
    <h2>Signin to your account</h2>
    
    <h4>Do not have acoount yet? Click here for <a href="Signup.php">Sign Up</a> </h4>
<form name="login_form" action="SignIn.php" method="POST" class="login_form"  onsubmit = "validation()">

  <div class="container_SI">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="uname" required>

    <label for="psw"><b>Password</b><label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit" class="login_submit" name="submit">Login</button>
    <!-- <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label> -->
  </div>

  <div class="container_login" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Forgot password?</button>
    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
  </div>
</form>
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