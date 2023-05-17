<?php
require("dbcont.php");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$Error = [];
$message = "";
if (isset($_POST['submit'])) {
  //define variable to the input names
  $Fname = $_POST['Fname'];
  $Lname = $_POST['Lname'];
  $email = $_POST['email'];
  $phoneno = $_POST['phoneno'];
  $address = $_POST['Address'];
  $State = $_POST['State'];
  $Pincode = $_POST['Pincode'];
  $Uname = $_POST['Uname'];
  $psw = $_POST['psw'];
  $rpsw = $_POST['psw-repeat'];

  //validation and sanitization of the data.
  if (!empty($Fname)) {
    if (preg_match('/^[a-zA-Z\s]+$/', $Fname)) {
      $Fname = mysqli_real_escape_string($conn, trim($Fname));
    } else {
      array_push($Error, "Please enter vaild name.<br>");
    }
  } else {
    array_push($Error, "Please enter your name.<br>");
  }
  if (!empty($Lname)) {
    if (preg_match('/^[a-zA-Z]+$/', $Lname)) {
      $Lname = mysqli_real_escape_string($conn, trim($Lname));
    } else {
      array_push($Error, "Please enter vaild name.<br>");
    }
  } else {
    array_push($Error, "Please enter your name.<br>");
  }
  if (!empty($email)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $Email = mysqli_real_escape_string($conn, trim($email));
    } else {
      array_push($Error, "Please emter valid Email ID.<br>");
    }
  } else {
    array_push($Error, "Please enter your Email ID.<br>");
  }
  if (!empty($phoneno)) {
    if (preg_match('/^\([0-9]{3}\)\s[0-9]{3}\-[0-9]{4}+$/', $phoneno)) {
      $phoneno = mysqli_real_escape_string($conn, trim($phoneno));
    } else {
      array_push($Error, "Please enter cell number in valid format. Valid format: (123) 456-6780.<br>");
    }
  } else {
    array_push($Error, "Please enter your cell number.<br>");
  }
  if (!empty($address)) {
    if (preg_match('/^[\w]+/', $address)) {
      $address = mysqli_real_escape_string($conn, trim($address));
    } else {
      array_push($Error, "Please enter vaild address.No special characters allowd.<br>");
    }
  } else {
    array_push($Error, "Please enter your address.<br>");
  }
  if (!empty($State)) {
    if (preg_match('/^[\w]+/', $State)) {
      $State = mysqli_real_escape_string($conn, trim($State));
    } else {
      array_push($Error, "Please enter vaild State.No special characters allowd.<br>");
    }
  } else {
    array_push($Error, "Please enter your State.<br>");
  }
  // if(!empty($State)) {
  //     $State = mysqli_real_escape_string($conn, trim($State));
  //   }
  //   else {
  //   array_push($Error,"Please select your State.<br>");
  //   }
  if (!empty($Pincode)) {
    if (preg_match('/^[\w]+/', $Pincode)) {
      $Pincode = mysqli_real_escape_string($conn, trim($Pincode));
    } else {
      array_push($Error, "Please enter vaild Pincode.No special characters allowd.<br>");
    }
  } else {
    array_push($Error, "Please enter your Pincode.<br>");
  }

  if (!empty($Uname)) {
    if (preg_match('/^[\w]+/', $Uname)) {
      $Uname = mysqli_real_escape_string($conn, trim($Uname));
      $usql = "SELECT * FROM user_master where userName = '$Uname'";  
      $uresult = mysqli_query($conn, $usql);  
      $urow = mysqli_fetch_array($uresult, MYSQLI_ASSOC);  
      $ucount = mysqli_num_rows($uresult);
      // $uFname = "SELECT userFname FROM user_master where userName = '$Uname';";
      // session_start();
      //     $_SESSION['Fname'] = $Fname;
      if($ucount == 1){  
        array_push($Error,"You already have an account! Please <a href='SignIn.php'>Sign In</a><br>");
      } 
    } else {
      array_push($Error, "Please enter vaild State.No special characters allowd.<br>");
    }
  } else {
    array_push($Error, "Please enter your State.<br>");
  }
  if (!empty($psw)) {
    if ($psw == $rpsw) {
      $psw = password_hash(mysqli_real_escape_string($conn, trim($psw)),PASSWORD_DEFAULT);
    } else {
      array_push($Error, "Password is not matcing with repeat password.<br>");
    }
  } else {
    array_push($Error, "Please enter your password.<br>");
  }
  //displaying Eroor if there is any other wise redirecting to sucess page.
  if (!empty($Error)) {
    foreach ($Error as $error) {
      // echo "<script>alert('ohh! Error in signup. Please try again.');<script>";
      $message = $error;
    }
  } else {
    //inserting the values to the DB.
    $sql = "INSERT INTO user_master (`userName`,`userPassword`,`userFname`, `userLname`, `userTelephone`, `userEmail`, `userAddress`, `userCity`, `userPostalcode`) VALUES (?,?,?,?,?,?,?,?,?);";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssssss', $Uname, $psw, $Fname, $Lname, $phoneno, $email, $address, $State, $Pincode);
    $result = mysqli_stmt_execute($stmt);
  
    if ($result == 1) {
      $message= $Fname .",You have sign up sucessfully!";
    } else {
      $message ="ohh! Error in signup. Please try again.";
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
  <title>TMOLA- SignUp</title>
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
    <span style="color=red;"><?php echo $message; ?></span>
    <h2>Sign Up</h2>
    
    <form action="signup.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">

        <p>Please fill in this form to create an account.</p>
        <p>Already have an account? Click here for <a href="signin.php">Sign In.</a> </p>
        <hr>

        <label for="Fname"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="Fname">

        <label for="Lname"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="Lname">

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="someone@somthing.com" name="email">

        <label for="phoneno"><b>Phone Number</b></label>
        <input type="text" placeholder="(123) 456-7890" name="phoneno">

        <label for="Address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="Address">

        <label for="State"><b>State</b></label>
        <input type="text" placeholder="Enter state" name="State">

        <!-- <label for="state"><b>state</b></label><br>
    <select name="state">
	<option value="" selected="selected"> - Province - </option>
	<option value="AB">Alberta</option>
	<option value="BC">British Columbia</option>
	<option value="MB">Manitoba</option>
	<option value="NB">New Brunswick</option>
	<option value="NL">Newfoundland and Labrador</option>
	<option value="NS">Nova Scotia</option>
	<option value="NT">Northwest Territories</option>
	<option value="NU">Nunavut</option>
	<option value="ON">Ontario</option>
	<option value="PE">Prince Edward Island</option>
	<option value="QC">Quebec</option>
	<option value="SK">Saskatchewan</option>
	<option value="YT">Yukon</option>
	<option value=""> - States - </option>
	<option value="AL">Alabama</option> 
	<option value="AK">Alaska</option> 
	<option value="AZ">Arizona</option> 
	<option value="AR">Arkansas</option> 
	<option value="CA">California</option> 
	<option value="CO">Colorado</option> 
	<option value="CT">Connecticut</option> 
	<option value="DE">Delaware</option> 
	<option value="DC">District Of Columbia</option> 
	<option value="FL">Florida</option> 
	<option value="GA">Georgia</option> 
	<option value="HI">Hawaii</option> 
	<option value="ID">Idaho</option> 
	<option value="IL">Illinois</option> 
	<option value="IN">Indiana</option> 
	<option value="IA">Iowa</option> 
	<option value="KS">Kansas</option> 
	<option value="KY">Kentucky</option> 
	<option value="LA">Louisiana</option> 
	<option value="ME">Maine</option> 
	<option value="MD">Maryland</option> 
	<option value="MA">Massachusetts</option> 
	<option value="MI">Michigan</option> 
	<option value="MN">Minnesota</option> 
	<option value="MS">Mississippi</option> 
	<option value="MO">Missouri</option> 
	<option value="MT">Montana</option> 
	<option value="NE">Nebraska</option> 
	<option value="NV">Nevada</option> 
	<option value="NH">New Hampshire</option> 
	<option value="NJ">New Jersey</option> 
	<option value="NM">New Mexico</option> 
	<option value="NY">New York</option> 
	<option value="NC">North Carolina</option> 
	<option value="ND">North Dakota</option> 
	<option value="OH">Ohio</option> 
	<option value="OK">Oklahoma</option> 
	<option value="OR">Oregon</option> 
	<option value="PA">Pennsylvania</option> 
	<option value="RI">Rhode Island</option> 
	<option value="SC">South Carolina</option> 
	<option value="SD">South Dakota</option> 
	<option value="TN">Tennessee</option> 
	<option value="TX">Texas</option> 
	<option value="UT">Utah</option> 
	<option value="VT">Vermont</option> 
	<option value="VA">Virginia</option> 
	<option value="WA">Washington</option> 
	<option value="WV">West Virginia</option> 
	<option value="WI">Wisconsin</option> 
	<option value="WY">Wyoming</option>
</select><br> -->

        <label for="Pincode"><b>PIN Code</b></label>
        <input type="text" placeholder="Enter Pincode" name="Pincode">

        <label for="Uname"><b>User Id</b></label>
        <input type="text" placeholder="Enter User ID" name="Uname">

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw">

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat">


        <p>By creating an account you agree to our <a href="PrivacyPolicy.php" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
          <button type="submit" class="login_submit" name="submit">Sign Up</button>
          <!-- <button type="button" class="cancelbtn">Cancel</button> -->
        </div>
      </div>
    </form>
  </div>
</body>
<footer>
  <?php
  include('footer.php');
  ?>
</footer>

</html>