<?php
require("dbcont.php");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$dbproductId;
$dbcategoryId;
$dbdiscountId;
$dproductName;
$dbproductPrice;
$dbproductQuality;
$dbproductQuantity;
$dbproductImage;
$dbproductshort;
$dbproductModel;
$dbproductImage;
function product_id($cid)
{
  $conn = mysqli_connect(Server, Username, Password, DatabaseName);
  $sql = "SELECT productId from product_master where categoryId=$cid";
  $id = mysqli_query($conn, $sql);
  // $pid = mysqli_fetch_assoc($id);
  if (mysqli_num_rows($id) > 0) {
    //create an empty array to store the column values
    $pid = array();
  
    //loop through the result set and store the column values in the array
    while ($row = mysqli_fetch_assoc($id)) {
      $pid[] = $row['productId'];
    }
  }
  // $query_run = mysqli_query($conn, $sql);
  // if ($query_run->num_rows > 0) {
  //   foreach ($query_run as $row) {
  //     $pid[] = mysqli_fetch_assoc($id);
  //   }
  // }
  if(!empty($pid)){
  return $pid;
  } else {
    return "No product available to display!!";
  }

}
//for getting id with main category
function product_mainid($cid)
{
  $conn = mysqli_connect(Server, Username, Password, DatabaseName);
  $sql = "SELECT productId FROM product_master where categoryId=$cid and Main='Yes';";
  $id = mysqli_query($conn, $sql);
  // $pid = mysqli_fetch_assoc($id);
  if (mysqli_num_rows($id) > 0) {
    //create an empty array to store the column values
    $pid = array();
  
    //loop through the result set and store the column values in the array
    while ($row = mysqli_fetch_assoc($id)) {
      $pid[] = $row['productId'];
    }
  }
  // $query_run = mysqli_query($conn, $sql);
  // if ($query_run->num_rows > 0) {
  //   foreach ($query_run as $row) {
  //     $pid[] = mysqli_fetch_assoc($id);
  //   }
  // }
  if(!empty($pid)){
  return $pid;
  } else {
    return "No product available to display!!";
  }

}


// foreach($pid as $p) {
//   $psql = "select * from product_master where productIdId=$p";
//   $r = mysqli_query($conn, $psql);
//   $prod = mysqli_fetch_assoc($r);
// }

function product_card($id)
{
  $conn = mysqli_connect(Server, Username, Password, DatabaseName);
  $sql = "select * from product_master where productId=$id ";
  $result = mysqli_query($conn, $sql);
  $product = mysqli_fetch_assoc($result);
  $dbproductId = $product["productId"];
  $dbcategoryId = $product["categoryId"];
  $dbdiscountId = $product["discountId"];
  $dproductName = $product["productName"];
  $dbproductPrice = $product["productPrice"];
  $dbproductQuality = $product["productQuality"];
  $dbproductQuantity = $product["productQuantity"];
  $dbproductImage = $product["ProductImages1"];
  $dbproductshort = $product["productShortDes"];
  $dbproductModel = $product["productModel"];
  $pro_detail = array($dbproductId, $dbcategoryId, $dbdiscountId, $dproductName, $dbproductPrice, $dbproductQuality, $dbproductQuantity, $dbproductImage, $dbproductshort, $dbproductModel);
  return $pro_detail;
}
//$result = $conn->query($sql);
// $sql = "select productId from product_master where categoryId=$id ";
// $id = mysqli_query($conn, $product);
// $pid = mysqli_fetch_assoc($id);
//         $query_run = mysqli_query($conn, $product);
//         if ($query_run->num_rows > 0) {
//             foreach ($query_run as $row) {
//               $dbproductId = $row["productId"];
//               $dbcategoryId = $row["categoryId"];
//               $dbdiscountId = $row["discountId"];
//               $dproductName = $row["productName"];
//               $dbproductPrice = $row["productPrice"];
//               $dbproductQuality = $row["productQuality"];
//               $dbproductQuantity = $row["productQuantity"];
//               $dbproductImage = $row["ProductImages1"];
//               $dbproductshort = $row["productShortDes"];
//               $dbproductModel = $row["productModel"];
//                 $pro_detail = array($dbproductId,$dbcategoryId,$dbdiscountId,$dproductName,$dbproductPrice,$dbproductQuality,$dbproductQuantity,$dbproductImage,$dbproductshort,$dbproductModel);
//                 return $pro_detail;
// }

//   }

// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- Home</title>
  <link href="main.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.css" rel="stylesheet">
  <link href="https:////cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/accessible-slick-theme.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
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
  <div class="product_main">
    <!-- Mobiles -->
    <h2 class="cat_1">Mobiles </h2>
    <div class="main_card_1" id="main_card">
      <?php $m = product_mainid(101);
  foreach ($m as $value) {
    $n = product_card($value) ;?>
    <a href="productdetail.php?pid=<?php echo $n[0];?>">
        <img src="<?php 
    echo $n[7];?>" alt="<?php
    echo $n[3];?>" style="height:300px; width:250px">
        <h4><?php 
    echo $n[3];?></h4>
        <p class="price"><?php
    echo $n[4];;?></p>
        <p><?php 
    echo $n[8];?></p>
    <?php 
      ?>
        <p><button>Add to Cart</button></p>
      </a>
<?php  }
      ?>
    </div>
    <div class="card-slider" id="card_slider_1">
    
    <?php $m = product_id(101);
  foreach ($m as $value) {
    $n = product_card($value) ;?>
    <div class="card2" id="card">
    <a href="productdetail.php?pid=<?php echo $n[0];?>">
        <img src="<?php 
    echo $n[7];?>" alt="<?php
    echo $n[3];?>" style="height:200px; width:200px">
        <h4><?php 
    echo $n[3];?></h4>
        <p class="price"><?php
    echo $n[4];;?></p>
        <p><?php 
    echo $n[8];?></p>
    <?php 
      ?>
        <p><button>Add to Cart</button></p>
      </a>
      </div>
<?php  }
      ?>
      
      </div>


      <!-- Laptops -->
    <h2 class="cat_2">Laptops </h2>
    <div class="main_card_2" id="main_card">
      <?php $m = product_mainid(102);
  foreach ($m as $value) {
    $n = product_card($value) ;?>
    <a href="productdetail.php?pid=<?php echo $n[0];?>">
        <img src="<?php 
    echo $n[7];?>" alt="<?php
    echo $n[3];?>" style="height:300px; width:250px">
        <h4><?php 
    echo $n[3];?></h4>
        <p class="price"><?php
    echo $n[4];;?></p>
        <p><?php 
    echo $n[8];?></p>
    <?php 
      ?>
        <p><button>Add to Cart</button></p>
      </a>
<?php  }
      ?>
    </div>
    <div class="card-slider" id="card_slider_2">
    
    <?php $m = product_id(102);
  foreach ($m as $value) {
    $n = product_card($value) ;?>
    <div class="card2" id="card">
    <a href="productdetail.php?pid=<?php echo $n[0];?>">
        <img src="<?php 
    echo $n[7];?>" alt="<?php
    echo $n[3];?>" style="height:200px; width:200px">
        <h4><?php 
    echo $n[3];?></h4>
        <p class="price"><?php
    echo $n[4];;?></p>
        <p><?php 
    echo $n[8];?></p>
    <?php 
      ?>
        <p><button>Add to Cart</button></p>
      </a>
      </div>
<?php  }
      ?>
      
      </div>

      <!-- Televisions -->
    <h2 class="cat_3">Televisions </h2>
    <div class="main_card_3" id="main_card">
      <?php $m = product_mainid(100);
  foreach ($m as $value) {
    $n = product_card($value) ;?>
    <a href="productdetail.php?pid=<?php echo $n[0];?>" >
        <img src="<?php 
    echo $n[7];?>" alt="<?php
    echo $n[3];?>"style="height:300px; width:250px">
        <h4><?php 
    echo $n[3];?></h4>
        <p class="price"><?php
    echo $n[4];;?></p>
        <p><?php 
    echo $n[8];?></p>
    <?php 
      ?>
        <p><button>Add to Cart</button></p>
      </a>
<?php  }
      ?>
    </div>
    <div class="card-slider" id="card_slider_3">
    
    <?php $m = product_id(100);
  foreach ($m as $value) {
    $n = product_card($value) ;?>
    <div class="card2" id="card">
    <a href="productdetail.php?pid=<?php echo $n[0];?>">
        <img src="<?php 
    echo $n[7];?>" alt="<?php
    echo $n[3];?>" style="height:200px; width:200px">
        <h4><?php 
    echo $n[3];?></h4>
        <p class="price"><?php
    echo $n[4];;?></p>
        <p><?php 
    echo $n[8];?></p>
    <?php 
      ?>
        <p><button>Add to Cart</button></p>
      </a>
      </div>
<?php  }
      ?>
      </div>
      </div>
</body>
<footer>
  <?php
  include('footer.php');
  ?>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>
<script>
  $(document).ready(function() {
    $('.card-slider').slick({
      dots: false,
      arrows: true,
      slidesToShow: 4,
      infinite: false,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1
          }
        }
      ]
    });
  });
</script>

</html>