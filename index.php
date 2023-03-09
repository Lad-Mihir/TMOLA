<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- Home</title>
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
    <section class="photo_grid">
      <div class="row">
        <div class="column">
          <div class="pro_card">
            <img src="Assets/Homepage/3.jpg" style="width:100%; height:40%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
          <div class="pro_card">
            <img src="Assets/Homepage/1.jpg" style="width:100%; height:20%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
          <div class="pro_card">
            <img src="Assets/Homepage/2.jpg" style="width:100%; height:30%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="pro_card">
            <img src="Assets/Homepage/4.jpg" style="width:100%; height:25%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
          <div class="pro_card">
            <img src="Assets/Homepage/1.jpg" style="width:100%; height:30%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
          <div class="pro_card">
            <img src="Assets/Homepage/5.jpg" style="width:100%; height:35%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
        </div>
        <div class="column">
          <div class="pro_card">
            <img src="Assets/Homepage/6.jpg" style="width:100%; height:35%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
          <div class="pro_card">
            <img src="Assets/Homepage/7.jpg" style="width:100%; height:30%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
          <div class="pro_card">
            <img src="Assets/Homepage/1.jpg" style="width:100%; height:25%">
            <div class="deal_text">
              <span class="name">Item name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="old_price">Price</span><br>
              <span class="model_name">Model name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dis_price">Price2</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="button_div">
      <button class="button">View all Products</button>
    </div>
    <section class="Product_dis">
      <div class="dis1">
        <a href="productlist.php">
          <img src="Assets/Homepage/7.jpg"><br>
          <div class="dis_button1">
            <strong>Mobiles</strong>
          </div>
        </a>
      </div>
      <div class="dis2">
        <a href="productlist.php">
          <img src="Assets/Homepage/8.jpg"><br>
          <div class="dis_button1">
            <strong>Televisons</strong>
          </div>
        </a>
      </div>
      <div class="dis3">
        <a href="productlist.php">
          <img src="Assets/Homepage/7.jpg"><br>
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