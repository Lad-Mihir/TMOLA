<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require("dbcont.php");
			$Error = [];
			$message ="";
			//Validating fuction for Age.
			// function Age_validate7976($age)
			// {
			// 	global $Error;
			// 	global $Age;
			// 	if ($age < 16) {
			// 		array_push($Error, "Under 16 years are not allowed.<br>");
			// 	} elseif ($age >= 16 && $age < 18) {
			// 		array_push($Error, "Age between 16 and 18 years are alloed with Constent.<br>");
			// 	} elseif ($age > 60) {
			// 		array_push($Error, "Age above 60 years are not allowed.<br>");
			// 	} else {
			// 		$Age = $age;
			// 	}
			// }

			//seting criteria for the form to sanitize the data enter by the user.
			if (isset($_POST['Submit'])) {
				if (!empty($_POST['Name'])) {
					if (preg_match('/^[a-zA-Z\s]+$/', $_POST['Name'])) {
						$Name = $_POST['Name'];
					} else {
						array_push($Error, "Please enter vaild name. Special characters are not allowed.<br>");
					}
				} else {
					array_push($Error, "Please enter your name.<br>");
				}
				
				$message = $_POST['subject'];
				
				if (!empty($_POST['Email'])) {
					if (filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
						$Email = $_POST['Email'];
					} else {
						array_push($Error, "Please emter valid Email ID.<br>");
					}
				} else {
					array_push($Error, "Please enter your Email ID.<br>");
				}
				if (!empty($_POST['PhoneNo'])) {
						$PhoneNo = $_POST['PhoneNo'];
				} else {
					array_push($Error, "Please enter your phone number.<br>");
				}
				//displaying Eroor if there is any other wise redirecting to sucess page.
				if (!empty($Error)) {
					$message = $Error;
					
				} else {
					$conn = mysqli_connect(Server,Username,Password,DatabaseName);
    				$sql = "INSERT into `conatct_form` (`name`, `email`, `phoneno`, `message`) values (?,?,?,?);";
					$stmt = mysqli_prepare($conn, $sql);
					mysqli_stmt_bind_param($stmt, 'ssss', $Name,$Email,$PhoneNo,$message);
					$result = mysqli_stmt_execute($stmt);
				  
					if ($result == 1) {
					header('Location:sucess.php');
					} else {
						$m = "Something Went wrong! Please try again.";
					}

				}
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
	<div class="hor_ad">
		<img src="Assets/Homepage/9.jpg" style="width:100%; height:200px">
	</div>
	<section class="conatct_us">
		<h1 class="conatct_line">Need to Contact Us?</h1>
		<div class="contact_1">
			<img src="Assets/Icons/mail.png" style="width:100%; height:100%">
		</div>
		<div class="contact_2">
			<strong>Email Us at </strong><br>
			<a href="mailto:support@tmola.ca">support@tmola.ca</a>
		</div>
		<div class="contact_3">
			<img src="Assets/Icons/call.png" style="width:100%; height:100%">
		</div>
		<div class="contact_4">
			<strong>Call on</strong><br>
			<a href="callto:+1(416)836-5634">+1 (416)836-5634</a>
		</div>
		<div class="contact_5">
			<img src="Assets/Icons/store.png" style="width:100%; height:100%">
		</div>
		<div class="contact_6">
			<p><b>Visit our physical store</b> <br>
			<address>200 Waterbrook lane,<br>
				Kitchener, ON. Canada.<br>
				N2P 0H7.
		</div>
		<h1 class="conatct_form_line">Do you have any queries?</h1>
		
		<!-- <p >If you have any questions or concerns, please don't hesitate to reach out to us. Our customer service team is available 24/7 to assist you.</p> -->
		<form action="contactus.php" method="POST" class="contact_form">
			
			<!--incerting table for the better visual experience-->
			<table id="table_conatct">
			<span style="color:red;"><?php if(!empty($message)) {
			foreach($message as $m) {
			echo $m;
			}
		} ?></span>
				<tr>
					<th>Name<span id="span">*</span>: </th>
					<th><input type="text" name="Name" value="" Placeholder="Your name here..."></th>
				</tr>
				<tr>
					<th>Email<span id="span">*</span>: </th>
					<th><input type="text" name="Email" value="" Placeholder="Your valid Email ID here..."></th>
				</tr>
				<tr>
					<th>Phone Number<span id="span">*</span>: </th>
					<th><input type="text" name="PhoneNo" value="" Placeholder="Your Phone number here..."></th>
				</tr>
				<tr>
					<th><label for="subject">Message</label></th>
					<th><textarea id="subject" name="subject" placeholder="Write something.." style="height:50px"></textarea></th>
				</tr>
				<tr>
					<th><input type="Submit" name="Submit"></th>
				</tr>
			</table>
		</form>
			<div class="gmap_canvas">
				<iframe width="800" height="350" src="https://maps.google.com/maps?q=200%20water%20brooklane,%20kitchenere&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
			    </iframe>
			</div>
	</section>
</body>
<footer>
	<?php
	include('footer.php');
	?>
</footer>

</html>