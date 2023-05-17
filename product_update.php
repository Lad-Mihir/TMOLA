<?php
require("dbcont.php");
$id = $_GET['id'];
$message = "";
$Error = [];

if (isset($_POST['Back'])) {
  header("Location:admin_panel.php");
}
// $rsql = "SELECT * FROM product_master where productid = '$id';";
// //fatch the single row 
// $result = mysqli_query($conn, $rsql);
// $userinfo = mysqli_fetch_assoc($result);

if (isset($_GET['submit'])) {
  $id = $_GET['pid'];
  $pname = $_GET['pname'];
  $cat = $_GET['cat'];
  $pmodel = $_GET['pmodel'];
  $price = $_GET['price'];
  $dprice = $_GET['dprice'];
  $sdes = $_GET['sdes'];
  $des = $_GET['des'];
  $overview = $_GET['overview'];
  $feature = $_GET['feature'];
  $addinfo = $_GET['addinfo'];
  $warranty = $_GET['warranty'];
  $feature = $_GET['feature'];
  $addinfo = $_GET['addinfo'];
  if (isset($_GET['adv'])) {
    // Checkbox was checked
    $Adv = $_GET['Adv'];
  } else {
    // Checkbox was not checked, set $Adv to null or some other default value
    $Adv = null;
  }
  if (isset($_GET['main'])) {
    // Checkbox was checked
    $Main = $_GET['main'];
  } else {
    // Checkbox was not checked, set $Adv to null or some other default value
    $Main = null;
  }



  if (!empty($pname)) {
    $pname = mysqli_real_escape_string($conn, trim($pname));
  } else {
    array_push($Error, 'Please enter the product name!<br>');
  }
  if (!empty($cat)) {
    if (preg_match('/^[0-9]+$/', $cat)) {
      $cat = mysqli_real_escape_string($conn, trim($cat));
    } else {
      array_push($Error, "Please enter vaild category.<br>");
    }
  } else {
    array_push($Error, 'Please enter the category!<br>');
  }

  if (!empty($pmodel)) {
      $pmodel = mysqli_real_escape_string($conn, trim($pmodel));
  } else {
    array_push($Error, 'Please enter the Model!');
  }
  if (!empty($price)) {
    if (preg_match('/^[0-9]+/', $price)) {
      $price = mysqli_real_escape_string($conn, trim($price));
    } else {
      array_push($Error, "Please enter vaild price.<br>");
    }
  } else {
    array_push($Error, 'Please enter the price!');
  }
  if (!empty($dprice)) {
    if (preg_match('/^[0-9]+/', $dprice)) {
      $dprice = mysqli_real_escape_string($conn, trim($dprice));
    } else {
      array_push($Error, "Please enter vaild price.<br>");
    }
  } else {
    echo 'Please enter the price!';
  }
  if (!empty($sdes)) {
    $sdes = mysqli_real_escape_string($conn, trim($sdes));
  } else {
    array_push($Error, "Please enter vaild text for short description.<br>");
  }
  if (!empty($des)) {
    $des = mysqli_real_escape_string($conn, trim($des));
  } else {
    array_push($Error, "Please enter vaild text for description.<br>");
  }
  if (!empty($feature)) {
    $feature = mysqli_real_escape_string($conn, trim($feature));
  } else {
    array_push($Error, "Please enter vaild text for featues.<br>");
  }
  if (!empty($addinfo)) {
    $addinfo = mysqli_real_escape_string($conn, trim($addinfo));
  } else {
    array_push($Error, "Please enter vaild text for additional information.<br>");
  }


  //for uploading an image...


  $target_dir = "Assets/Homepage/";

  if (isset($_FILES['FrontView'])) {
    $target_file1 = $target_dir . basename($_FILES["FrontView"]["name"]);
  } else {
    $target_file1 = $_GET['FrontView'];
  }
  if (isset($_FILES['SideView'])) {
    $target_file2 = $target_dir . basename($_FILES["SideView"]["name"]);
  } else {
    $target_file2 = $_GET['SideView'];
  }
  if (isset($_FILES['TopView'])) {
    $target_file3 = $target_dir . basename($_FILES["TopView"]["name"]);
  } else {
    $target_file3 = $_GET['TopView'];
  }
  $imageFileType1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
  $imageFileType2 = strtolower(pathinfo($target_file2, PATHINFO_EXTENSION));
  $imageFileType3 = strtolower(pathinfo($target_file3, PATHINFO_EXTENSION));

  echo $target_file3;


  //updateing the table if there is no error
  if (!empty($Error)) {
    // foreach ($Error as $error) {
    // echo "<script>alert('ohh! Error in signup. Please try again.');<script>";
    $ma = $Error;
    $rsql = "SELECT * FROM product_master where productid = '$id';";
    //fatch the single row 
    $result = mysqli_query($conn, $rsql);
    $userinfo = mysqli_fetch_assoc($result);
  } else {
    $usql = "UPDATE `product_master` set `productName`='$pname', `CategoryId`='$cat', `productModel`='$pmodel', `productPrice`='$price', `discountPrice`='$dprice', `productShortDes`='$sdes', `productDescription`='$des', `productOverview`='$overview', `productFeatures`='$feature', `productAdditionalInfo`='$addinfo', `productWarranty`='$warranty',  `Adv`='$Adv', `Main`='$Main',`ProductImages1`='$target_file1', `ProductImages2`='$target_file2', `ProductImages3`='$target_file3' where `productId`=$id ;";
    // if (mysqli_query($conn, $usql)) {
    //   echo 'Record updated';
    // } else {
    //   echo "Error in updating database: " . mysqli_error($conn);
    // }
    //save to DB 
    if (mysqli_query($conn, $usql)) {
      $message = 'Record updated';
      $rsql = "SELECT * FROM product_master where productid = '$id';";
      //fatch the single row 
      $result = mysqli_query($conn, $rsql);
      $userinfo = mysqli_fetch_assoc($result);
      $old_info = $userinfo;
    } else {
      $message = "Error in updating database" . mysqli_error($conn);
      $rsql = "SELECT * FROM product_master where productid = '$id';";
      //fatch the single row 
      $result = mysqli_query($conn, $rsql);
      $userinfo = mysqli_fetch_assoc($result);
      // $imagepath1 = $userinfo['ProductImages1'];
      // $imagepath2 = $userinfo['ProductImages2'];
      // $imagepath3 = $userinfo['ProductImages3'];
      // $image_name1 = substr($imagepath1, strrpos($imagepath1, "/") + 1);
      // $image_name2 = substr($imagepath1, strrpos($imagepath2, "/") + 1);
      // $image_name3 = substr($imagepath1, strrpos($imagepath3, "/") + 1);

    }
  }
} 
else {

  //query
  $rsql = "SELECT * FROM product_master where productId = '$id';";
  //fatch the single row 
  $result = mysqli_query($conn, $rsql);
  $userinfo = mysqli_fetch_assoc($result);
  // $imagepath1 = $userinfo['ProductImages1'];
  //     $imagepath2 = $userinfo['ProductImages2'];
  //     $imagepath3 = $userinfo['ProductImages3'];
  //     $image_name1 = substr($imagepath1, strrpos($imagepath1, "/") + 1);
  //     $image_name2 = substr($imagepath1, strrpos($imagepath2, "/") + 1);
  //     $image_name3 = substr($imagepath1, strrpos($imagepath3, "/") + 1);
}
// echo $image_name1; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- Update product information</title>
  <link href="admin.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="Assets/Favicon.png">
</head>

<body>
  <div class="login">
    <form action="product_update.php?id=<?php echo $id; ?>" style="border:1px solid #ccc" class="login_form" method="GET" enctype="multipart/form-data">
      <div class="container_SI">
        
        <p>Update your product</p>
        <span style="color=red;"> <?php
                                  if (!empty($ma)) {
                                    foreach ($ma as $m) {
                                      echo $m;
                                    }
                                  } ?> </span>
        <hr>
        <input type="hidden" name="pid" value="<?php echo $id; ?>">
        <label for="pname"><b>Product Name</b></label>
        <input type="text" placeholder="Enter product name" name="pname" value="<?php echo $userinfo['productName']; ?>">

        <label for="cat"><b>Category Id</b></label>
        <input type="text" placeholder="Enter category Id" name="cat" value="<?php echo $userinfo['categoryId']; ?>">

        <label for="pmodel"><b>Product Model</b></label>
        <input type="text" placeholder="Enter product model" name="pmodel" value="<?php echo $userinfo['productModel']; ?>">

        <label for="price"><b>Price</b></label>
        <input type="text" placeholder="Enter price" name="price" value="<?php echo $userinfo['productPrice']; ?>">

        <label for="dprice"><b>Discounted Price</b></label>
        <input type="text" placeholder="Enter discounted price" name="dprice" value="<?php echo $userinfo['discountPrice']; ?>">

        <label for="sdes"><b>Short Description</b></label><br>
        <textarea placeholder="Enter short description" name="sdes" value="" rows="4" cols="59"><?php echo $userinfo['productShortDes']; ?></textarea><br><br>

        <label for="des"><b>Description</b></label><br>
        <textarea placeholder="Enter description" name="des" value="" rows="8" cols="59"><?php echo $userinfo['productDescription']; ?></textarea><br><br>

        <label for="overview"><b>Overview</b></label><br>
        <textarea placeholder="Enter overview" name="overview" value="" rows="4" cols="59"><?php echo $userinfo['productOverview']; ?></textarea><br><br>

        <label for="feature"><b>Features</b></label><br>
        <textarea placeholder="Enter Features" name="feature" value="" rows="4" cols="59"><?php echo $userinfo['productFeatures']; ?></textarea><br><br>

        <label for="addinfo"><b>Aditional Info</b></label><br>
        <textarea placeholder="Enter additional inforamtion" name="addinfo" value="" rows="4" cols="59"><?php echo $userinfo['productAdditionalInfo']; ?></textarea><br><br>

        <label for="warranty"><b>Warranty</b></label><br>
        <textarea placeholder="Enter Warranty" name="warranty" value="" rows="4" cols="59"><?php echo $userinfo['productWarranty']; ?></textarea><br><br>

        <label for="FrontView"><b>Front view</b></label><br><br>
        <img src="<?php echo $userinfo['ProductImages1']; ?>" style="height:50px; width:50px"><br><br>
        <input type="file" name="FrontView" id="fileToUpload" value="<?php echo $userinfo['ProductImages1']; ?>">
        <br><br>
        <hr>

        <label for="SideView"><b>Side view</b></label><br><br>
        <img src="<?php echo $userinfo['ProductImages2']; ?>" style="height:50px; width:50px"><br><br>
        <input type="file" name="SideView" id="fileToUpload1" value="<?php echo $userinfo['ProductImages2']; ?>"><br><br>
        <hr>

        <label for="TopView"><b>Top view</b></label><br><br>
        <img src="<?php echo $userinfo['ProductImages3']; ?>" style="height:50px; width:50px"><br><br>
        <input type="file" name="TopView" id="fileToUpload2" value="<?php echo $userinfo['ProductImages3']; ?>"><br><br>
        <hr>

        <input type="checkbox" id="adv" name="adv" value="Yes">
        <label for="adv"> Mark product for Advertisement on home screen</label> <br>

        <input type="checkbox" id="main" name="main" value="Yes">
        <label for="main"> Mark product as Main card on "All product" page.</label><br>

        <div class="clearfix">
          <button type="submit" class="login_submit" name="submit">Update Product Information</button>
          <button type="submit" class="cancelbtn" name="Back">Back</button>
        </div>
      </div>
    </form>
  </div>
</body>
<footer></footer>

</html>