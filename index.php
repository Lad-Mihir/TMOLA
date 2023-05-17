<?php
require("dbcont.php");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(isset($_GET['submit'])) {
  $d= $_GET['undersearch'];
  header("Location:filterproductlist.php?d=$d");
}
//geeting the product ids which are opt for the advertisement purpose.

$sql = "SELECT productId FROM product_master where Adv='Yes';";
$id = mysqli_query($conn, $sql);
if (mysqli_num_rows($id) > 0) {
  //create an empty array to store the column values
  $pid = array();
  //loop through the result set and store the column values in the array
  while ($row = mysqli_fetch_assoc($id)) {
    $pid[] = $row['productId'];
  }
}

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
  $dbdiscountPrice = $product["discountPrice"];
  $dbproductQuantity = $product["productQuantity"];
  $dbproductImage = $product["ProductImages1"];
  $dbproductshort = $product["productShortDes"];
  $dbproductModel = $product["productModel"];
  $pro_detail = array($dbproductId, $dbcategoryId, $dbdiscountId, $dproductName, $dbproductPrice, $dbdiscountPrice, $dbproductQuantity, $dbproductImage, $dbproductshort, $dbproductModel);
  return $pro_detail;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- Home</title>
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
  <section class="home">
    <div class="slideshow">
      <!-- Slideshow container -->
      <div class="slideshow-container">

        <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="Assets/Homepage/1.jpg" style="width:100%">
        </div>

        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="Assets/Homepage/2.jpg" style="width:100%">
          <!-- <div class="text">Caption Two</div> -->
        </div>

        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="Assets/Homepage/3.jpg" style="width:100%">
          <!-- <div class="text">Caption Three</div> -->
        </div>

        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

      </div>
      <br>

      <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div>
    </div>
    <!-- Deal photo show-->
    <section class="gallry">
      <?php 
      foreach ($pid as $id) {
        $n = product_card($id);
      ?>
      <div class="pro_card">
      <a href="productdetail.php?pid=<?php echo $n[0];?>">
        <img src="<?php 
    echo $n[7];?>" alt="<?php
    echo $n[3];?>" style="width:100%; height:100%">
        <div class="deal_text">
          <div class="name"><?php 
    echo $n[3];?></div>
          <div class="price">
            <span class="old_price"><?php 
    echo $n[5];?></span>
            <span class="dis_price"><?php 
    echo $n[4];?></span>
          </div>
        </div>
      </a>
      </div>
      <?php  }
      ?>
    </section>
    <div class="button_div">
      <a href="productlist.php">
      <button class="button">View all Products</button></a>
    </div>
    <section class="Product_dis">
      <div class="dis1">
        <a href="filterproductlist.php?a=101">
          <img src="Assets/Homepage/7.jpg"><br>
          <div class="dis_button1">
            <strong>Mobiles</strong>
          </div>
        </a>
      </div>
      <div class="dis2">
        <a href="filterproductlist.php?a=100">
          <img src="Assets/Homepage/4.jpg"><br>
          <div class="dis_button1">
            <strong>Televisons</strong>
          </div>
        </a>
      </div>
      <div class="dis3">
        <a href="filterproductlist.php?a=102">
          <img src="Assets/Homepage/2.jpg"><br>
          <div class="dis_button1">
            <strong>Laptops</strong>
          </div>
        </a>
      </div>
    </section>
  </section>


  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }
  </script>
</body>
<footer>
  <?php
  include('footer.php');
  ?>
</footer>

</html>