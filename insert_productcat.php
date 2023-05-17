<?php
require("dbcont.php");

$message="";
$Error = [];

if(isset($_POST['Back'])) {
    header("Location:admin_panel.php");
}


if (isset($_POST['submit'])) {
  
  
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
    array_push($Error, 'Please enter the category name!');
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
    $sql = "INSERT INTO product_category (`categoryName`) VALUES (?);";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $catname);
    $result = mysqli_stmt_execute($stmt);
  
    if ($result == 1) {
      $m= $catname .",has been added sucessfully!";
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
    <form action="insert_productcat.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
      <span style="color=red;"> <?php echo $message; ?> </span>
        <p>Add your product category</p>
      
        <hr>

       

        <label for="catname"><b>Category Name</b></label>
        <input type="text" placeholder="Enter category name" name="catname" value="">

        

        <div class="clearfix">
          <button type="submit" class="login_submit" name="submit">Add Product category</button>
          <button type="submit" class="cancelbtn" name="Back">Back</button>
        </div>
      </div>
    </form>
  </div>
</body>
<footer></footer>

</html>