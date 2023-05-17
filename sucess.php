<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
	<h4>Thank you for submitting the form!!!</h4>
    <p> we will contact you shortly!!</p>
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
          <img src="Assets/Homepage/8.jpg"><br>
          <div class="dis_button1">
            <strong>Televisons</strong>
          </div>
        </a>
      </div>
      <div class="dis3">
        <a href="filterproductlist.php?a=102">
          <img src="Assets/Homepage/7.jpg"><br>
          <div class="dis_button1">
            <strong>Laptops</strong>
          </div>
        </a>
      </div>
    </section> 
</body>
<footer>
	<?php
	include('footer.php');
	?>
</footer>

</html>