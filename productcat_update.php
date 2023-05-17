<?php
require("dbcont.php");
if(!empty($_GET['id'])) {
  $id= $_GET['id'];
}
$message="";
$Error = [];

if(isset($_POST['Back'])) {
    header("Location:admin_panel.php");
}


if (isset($_POST['submit'])) {
  
  $cat = $_POST['cat'];
  $catname = $_POST['catname'];
  

  // if (!empty($cat)) {
  //   if (preg_match('/^[a-zA-Z]+$/', $cat)) {
  //     $cat = mysqli_real_escape_string($conn, trim($cat));
  //   } else {
  //     array_push($Error, "Please enter vaild name.<br>");
  //   }
  // } else {
  //   echo 'Please enter the first name!';
  // }
  if (!empty($catname)) {
    
      $catname = mysqli_real_escape_string($conn, trim($catname));
  
  } else {
    echo 'Please enter the category name!';
  }
  
  

  //updateing the table if there is no error
  if (!empty($Error)) {
    foreach ($Error as $error) {
      // echo "<script>alert('ohh! Error in signup. Please try again.');<script>";
      $message = $error;
      $rsql = "SELECT * FROM product_category where categoryId = '$cat';";
      //fatch the single row 
      $result = mysqli_query($conn, $rsql);
      $userinfo = mysqli_fetch_assoc($result);
    }
  } else {
  $usql = "UPDATE `product_category` set `categoryName`='$catname' where `categoryId` = '$cat';";


  if (mysqli_query($conn, $usql)) {
    $m= 'Record updated';
    header("Location:admin_panel.php?m=$m");
  } else {
     $m = "Error in updating database". mysqli_error($conn);
     header("Location:admin_panel.php?m=$m");
  }
}
} else {
  
  //query
  $rsql = "SELECT * FROM product_category where categoryId = '$id';";
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
  <link href="asdmin.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="Assets/Favicon.png">
</head>

<body>
  <div class="login">
    <form action="productcat_update.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
      <span style="color=red;"> <?php echo $message; ?> </span>
        <p>Update your product category</p>
      
        <hr>

        <label for="cat"><b>Category Id</b></label>
        <input type="text" placeholder="Enter product name" name="cat" value="<?php echo $userinfo['categoryId'] ?>" readonly>

        <label for="catname"><b>Category Name</b></label>
        <input type="text" placeholder="Enter category name" name="catname" value="<?php echo $userinfo['categoryName'] ?>">

        

        <div class="clearfix">
          <button type="submit" class="login_submit" name="submit">Update Product category</button>
          <button type="submit" class="cancelbtn" name="Back">Back</button>
        </div>
      </div>
    </form>
  </div>
</body>
<footer></footer>

</html>