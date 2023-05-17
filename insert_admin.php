<?php
require("dbcont.php");

$message="";
$Error = [];

if(isset($_POST['Back'])) {
    header("Location:admin_panel.php");
}


if (isset($_POST['submit'])) {
  
  
  $Uname = $_POST['Uname'];
  $psw = $_POST['psw'];
  $rpsw = $_POST['psw-repeat'];

  if (!empty($Uname)) {
    if (preg_match('/^[\w]+/', $Uname)) {
      $Uname = mysqli_real_escape_string($conn, trim($Uname));
      $usql = "SELECT * FROM admin_master where adminName = '$Uname'";  
      $uresult = mysqli_query($conn, $usql);  
      $urow = mysqli_fetch_array($uresult, MYSQLI_ASSOC);  
      $ucount = mysqli_num_rows($uresult);
      // $uFname = "SELECT userFname FROM user_master where userName = '$Uname';";
      // session_start();
      //     $_SESSION['Fname'] = $Fname;
      if($ucount == 1){  
        array_push($Error,"You already have an account!<br>");
      } 
    } else {
      array_push($Error, "Please enter vaild name.<br>");
    }
  } else {
    array_push($Error, "Please enter your admin name.<br>");
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
  
  

  //updateing the table if there is no error
  if (!empty($Error)) {
    foreach ($Error as $error) {
      // echo "<script>alert('ohh! Error in signup. Please try again.');<script>";
      $message = $error;
      // $rsql = "SELECT * FROM product_category where categoryId = '$cat';";
      // //fatch the single row 
      // $result = mysqli_query($conn, $rsql);
      // $userinfo = mysqli_fetch_assoc($result);
    }
  } else {
    $conn = mysqli_connect(Server,Username,Password,DatabaseName);

    $sql = "INSERT INTO admin_master (`adminName`,`adminPassword`) VALUES (?,?);";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $Uname, $psw);
    $result = mysqli_stmt_execute($stmt);
  
    if ($result == 1) {
      $m= $Uname .",have been added sucessfully!";
      header("Location:admin_panel.php?m=$m");
    } else {
      $m ="ohh! Error in addup. Please try again.";
      header("Location:admin_panel.php?m=$m");
    }
}
} else {
  
  // //query
  // $rsql = "SELECT * FROM product_category where categoryId = '$id';";
  // //fatch the single row 
  // $result = mysqli_query($conn, $rsql);
  // $userinfo = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- SignIn</title>
  <link href="admin.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="Assets/Favicon.png">
</head>

<body>
  <div class="login">
    <form action="insert_admin.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
      <span style="color=red;"> <?php echo $message; ?> </span>
        <p>Add New Admin</p>
      
        <hr>

       

        <label for="Uname"><b>Admin Id</b></label>
        <input type="text" placeholder="Enter Admin ID" name="Uname">

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw">

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat">
        

        <div class="clearfix">
          <button type="submit" class="login_submit" name="submit">Add as Admin</button>
          <button type="submit" class="cancelbtn" name="Back">Back</button>
        </div>
      </div>
    </form>
  </div>
</body>
<footer></footer>

</html>