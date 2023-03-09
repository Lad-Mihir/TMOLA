<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMOLA- SignIn</title>
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
    <div class="hor_ad">
    <img src="Assets/Homepage/1.jpg" style="width:100%; height:200px">
    </div>
    <div class="login">
    <form action="/action_page.php" style="border:1px solid #ccc" class="login_form">
  <div class="container_SI">
    
    <p>Update your profile</p>
    <hr>

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="phoneno"><b>Phone Number</b></label>
    <input type="text" placeholder="Enter Phone No" name="phoneno" required>

    <label for="Address"><b>Address</b></label>
    <input type="text" placeholder="Enter Address" name="Address" required>
    
    <label for="State"><b>State</b></label>
    <input type="text" placeholder="Enter State" name="State" required>

    <label for="Pincode"><b>PIN Code</b></label>
    <input type="text" placeholder="Enter Pincode" name="Pincode" required>

    <div class="clearfix">
    <button type="submit" class="login_submit">Update Profile</button>
      <button type="button" class="cancelbtn">Cancel</button>
    </div>
  </div>
</form>
    </div>
    </body>
<footer>
    <?php
    include('footer.php');
    ?>
</footer>

</html>
