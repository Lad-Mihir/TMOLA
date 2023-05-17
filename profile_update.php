<?php
require("dbcont.php");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$userid = $_SESSION['userId'];
$message="";
$Error = [];
if (isset($_POST['submit'])) {
  $FirstName = $_POST['Fname'];
  $LastName = $_POST['Lname'];
  $Email = $_POST['email'];
  $phoneno = $_POST['phoneno'];
  $Address = $_POST['Address'];
  $State = $_POST['State'];
  $Pincode = $_POST['Pincode'];

  if (!empty($FirstName)) {
    if (preg_match('/^[a-zA-Z]+$/', $FirstName)) {
      $FirstName = mysqli_real_escape_string($conn, trim($FirstName));
    } else {
      array_push($Error, "Please enter vaild name.<br>");
    }
  } else {
    echo 'Please enter the first name!';
  }
  if (!empty($LastName)) {
    if (preg_match('/^[a-zA-Z]+$/', $LastName)) {
      $LastName = mysqli_real_escape_string($conn, trim($LastName));
    } else {
      array_push($Error, "Please enter vaild name.<br>");
    }
  } else {
    echo 'Please enter the last name!';
  }
  if (!empty($Email)) {
    if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
      $Email = mysqli_real_escape_string($conn, trim($Email));
    } else {
      array_push($Error, "Please emter valid Email ID.<br>");
    }
  } else {
    echo 'Please enter the Email ID!';
  }
  if (!empty($phoneno)) {
    if (preg_match('/^\([0-9]{3}\)\s[0-9]{3}\-[0-9]{4}+$/', $phoneno)) {
      $phoneno = mysqli_real_escape_string($conn, trim($phoneno));
    } else {
      array_push($Error, "Please enter cell number in valid format. Valid format: (123) 456-6780.<br>");
    }
  } else {
    echo 'Please enter the phone number!';
  }
  if (!empty($Address)) {
    if (preg_match('/^[\w]+/', $Address)) {
      $Address = mysqli_real_escape_string($conn, trim($Address));
    } else {
      array_push($Error, "Please enter vaild address.No special characters allowd.<br>");
    }
  } else {
    echo 'Please enter the Address!';
  }
  if (!empty($State)) {
    if (preg_match('/^[\w]+/', $State)) {
      $State = mysqli_real_escape_string($conn, trim($State));
    } else {
      array_push($Error, "Please enter vaild State.No special characters allowd.<br>");
    }
  } else {
    echo 'Please enter the State!';
  }
  if (!empty($Pincode)) {
    if (preg_match('/^[\w]+/', $Pincode)) {
      $Pincode = mysqli_real_escape_string($conn, trim($Pincode));
    } else {
      array_push($Error, "Please enter vaild Pincode.No special characters allowd.<br>");
    }
  } else {
    echo 'Please enter the Pincode!';
  }

  //updateing the table if there is no error
  if (!empty($Error)) {
    foreach ($Error as $error) {
      // echo "<script>alert('ohh! Error in signup. Please try again.');<script>";
      $message = $error;
      $rsql = "SELECT * FROM user_master where userid = '$userid';";
      //fatch the single row 
      $result = mysqli_query($conn, $rsql);
      $userinfo = mysqli_fetch_assoc($result);
    }
  } else {
  $usql = "UPDATE `user_master` set `userFname`='$FirstName', `userLname`='$LastName', `userEmail`='$Email', `userTelephone`='$phoneno', `userAddress`='$Address', `userCity`='$State', `userPostalcode`='$Pincode' where `userId`=$userid ;";
  // if (mysqli_query($conn, $usql)) {
  //   echo 'Record updated';
  // } else {
  //   echo "Error in updating database: " . mysqli_error($conn);
  // }
  //save to DB 
  if (mysqli_query($conn, $usql)) {
    $message= 'Record updated';
    $rsql = "SELECT * FROM user_master where userid = '$userid';";
    //fatch the single row 
    $result = mysqli_query($conn, $rsql);
    $userinfo = mysqli_fetch_assoc($result);
    $old_info = $userinfo;
  } else {
     $message = "Error in updating database". mysqli_error($conn);
     $rsql = "SELECT * FROM user_master where userid = '$userid';";
    //fatch the single row 
    $result = mysqli_query($conn, $rsql);
    $userinfo = mysqli_fetch_assoc($result);
  }
}
} else {
  
  //query
  $rsql = "SELECT * FROM user_master where userid = '$userid';";
  //fatch the single row 
  $result = mysqli_query($conn, $rsql);
  $userinfo = mysqli_fetch_assoc($result);
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
    <img src="Assets/Homepage/9.jpg" style="width:100%; height:200px">
  </div>
  <div class="login">
    <form action="Profile_update.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
      <span style="color=red;"> <?php echo $message; ?> </span>
        <p>Update your profile</p>
      
        <hr>

        <label for="Fname"><b>First Name</b></label>
        <input type="text" placeholder="Enter first name" name="Fname" value="<?php echo $userinfo['userFname'] ?>">

        <label for="Lname"><b>First Name</b></label>
        <input type="text" placeholder="Enter last name" name="Lname" value="<?php echo $userinfo['userLname'] ?>">

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $userinfo['userEmail'] ?>">

        <label for="phoneno"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter Phone No" name="phoneno" value="<?php echo $userinfo['userTelephone'] ?>">

        <label for="Address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="Address" value="<?php echo $userinfo['userAddress'] ?>">

        <label for="State"><b>State</b></label>
        <input type="text" placeholder="Enter State" name="State" value="<?php echo $userinfo['userCity'] ?>">

        <label for="Pincode"><b>PIN Code</b></label>
        <input type="text" placeholder="Enter Pincode" name="Pincode" value="<?php echo $userinfo['userPostalcode'] ?>">

        <div class="clearfix">
          <button type="submit" class="login_submit" name="submit">Update Profile</button>
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