<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require("dbcont.php");

$userId = $_SESSION['userId'];
$sql = "SELECT * FROM user_master where userid = '$userId';";
$result = mysqli_query($conn, $sql);
$Pinfo = mysqli_fetch_assoc($result);
// print_r($Pinfo);
// $UFname = "SELECT userFname FROM user_master where userid = '$id';";
// $ULname = "SELECT userLname FROM user_master where userid = '$id';";
// $Uemail = "SELECT userEmail FROM user_master where userid = '$id';";
// $Uphoneno = "SELECT userTelephone FROM user_master where userid = '$id';";
// $Uaddress = "SELECT userAddress FROM user_master where userid = '$id';";
// $UState = "SELECT userCity FROM user_master where userid = '$id';";
// $UPin = "SELECT userPostalcode FROM user_master where userid = '$id';";

// function quritostring($a) {
//   $re = mysqli_query($conn, $a);  
//       $value = mysqli_fetch_array($re, MYSQLI_ASSOC); 
// echo $value;}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- User Profile</title>
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
    <h2>Personal Information</h2>
    <table>
      <tr>
        <th>First Name: </th>
        <td><?php echo $Pinfo['userFname'] ?></td>
      </tr>
      <tr>
        <th>Last Name: </th>
        <td><?php echo $Pinfo['userLname'] ?></td>
      </tr>
      <tr>
        <th>Email: </th>
        <td><?php echo $Pinfo['userEmail'] ?></td>
      </tr>
      <tr>
        <th>Phone Number: </th>
        <td><?php echo $Pinfo['userTelephone'] ?></td>
</tr>
      <tr>
        <th>Address: </th>
        <td><?php echo $Pinfo['userAddress'] ?></td>
      </tr>
      <tr>
        <th>State: </th>
        <td><?php echo $Pinfo['userCity'] ?></td>
      </tr>
      <tr>
        <th>Pin Number: </th>
        <td><?php echo $Pinfo['userPostalcode'] ?></td>
      </tr>
    </table>
    

      <!-- First Name:<?php echo $Pinfo['userFname'] ?><br>
      Last Name: <?php echo $Pinfo['userLname'] ?><br>
      Email: <?php echo $Pinfo['userEmail'] ?><br>
      Phone Number: <?php echo $Pinfo['userTelephone'] ?><br>
      Address: <?php echo $Pinfo['userAddress'] ?><br>
      State: <?php echo $Pinfo['userCity'] ?><br>
      Pin Number:<?php echo $Pinfo['userPostalcode'] ?> <br> -->
      </tr>
      <a href="profile_update.php"><button class="button" style="font-size:small">Update your profile</button></a> &nbsp; &nbsp; &nbsp; &nbsp;
      <a href="logout.php"><button class="button" style="font-size:small">Log Out from your Account</button></a><br><br>
      <a href="deletaccount.php"><span style="color:red; text-align:right">Delete your Account</span></a>
  </div>
</body>
<footer>
  <?php
  include('footer.php');
  ?>
</footer>

</html>