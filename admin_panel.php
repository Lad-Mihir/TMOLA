<?php



require("dbcont.php");

if(isset($_GET['m'])) {
  $m = $_GET['m'];
  echo "<script> alert('$m'); </script>";
}

function result($table) {
//   define('Server', 'Localhost');
// define('Password', 'TMOLA@54321');
// define('Username', 'tmolasit_Admin');
// define('DatabaseName', 'tmolasit_Main');
  $conn = mysqli_connect(Server, Username, Password, DatabaseName);
  $sql = "SELECT * FROM $table;";
  $result = mysqli_query($conn, $sql);
  return $result;
}


// function redirecting($p) {
//   global $id;
  
//   if(isset($_POST[$p])) {
//     $id= $_POST['id'];
//     header("Location:$p.php?id=$id");
//     exit();

//   }
// }
// function ids($p) {
//   if(isset($_POST[$p])) {
//         $id= $_POST['id'];
//         return $id;
// }
// }

// function redirecting($p) {
//   $ids = ids();
//   header("Location:$p.php?id= ids($p)");
// }


// redirecting("product_update");
// redirecting("product_delete");
// redirecting("admin_update");
// redirecting("admin_delete");
// redirecting("productcat_update");
// redirecting("user_delete");
// redirecting("order_delete");




?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- Admin</title>
  <link href="admin.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="Assets/Favicon.png">
</head>

<body>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Admin')" id="defaultOpen">Admin Master</button>
  <button class="tablinks" onclick="openCity(event, 'Users')">Users Master</button>
  <button class="tablinks" onclick="openCity(event, 'Product_cat')">Product Category</button>
  <button class="tablinks" onclick="openCity(event, 'Product')">Product Master</button>
  <button class="tablinks" onclick="openCity(event, 'Order')">User Contact messages</button>
  <button class="tablinks" onclick="openCity(event, 'Logout')">Log Out</button>
</div>

<div id="Admin" class="tabcontent">
  <h2>Admin</h2> 
    <form action="insert_admin.php">
    <div class='clearfix'><button type='submit'  class='login_submit' name='add_new' value='update'>Add new Admin</button></div>
    </form>
  <form action="admin_panel.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
  <?php
  $Admin = "admin_master";
  $admin = result($Admin) ;
  echo "
  <table>
<tr>
<th>Admin ID</th>
<th>Admin Name</th>
<th></th>
        </tr>";

    foreach ($admin as $r) {
      echo "<tr>";
      echo "<td>" . $r['adminId'] . "</td>";
      echo "<td>" . $r['adminName'] . "</td>";
      // echo "<td>" . $r['adminPassword'] . "</td>";
      echo "<td><div class='clearfix_button'><a href='admin_delete.php?id=".$r['adminId']."'>Delete</a></div></td>";
      echo "</tr>";
    }
    echo "
        </table>";
  ?>
  </div>
    
</div>

<div id="Users" class="tabcontent">
<h2>Users</h2>
<!-- <form action="insert_admin.php">
    <div class='clearfix'><button type='submit'  class='login_submit' name='add_new' value='update'>Add new User</button></div>
    </form> -->
  <form action="admin_panel.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
  <?php
  $Admin = "user_master";
  $admin = result($Admin) ;
  echo "
  <table>
<tr>
<th>User ID</th>
<th>User Name</th>
<th>First Name</th>
<th>Last Name</th>
<th>Phone Number</th>
<th>Email</th>
<th>Address</th>
<th>State</th>
<th>Postal code</th>

<th></th>
        </tr>";

    foreach ($admin as $r) {
      echo "<tr>";
    $i = $r['userId'] ;
      echo "<td>" . $r['userId'] . "</td>";
      echo "<td>" . $r['userName'] . "</td>";
      echo "<td>" . $r['userFname'] . "</td>";
      echo "<td>" . $r['userLname'] . "</td>";
      echo "<td>" . $r['userTelephone'] . "</td>";
      echo "<td>" . $r['userEmail'] . "</td>";
      echo "<td>" . $r['userAddress'] . "</td>";
      echo "<td>" . $r['userCity'] . "</td>";
      echo "<td>" . $r['userPostalcode'] . "</td>";
      // echo "<td>" .$i. "</td>";
    
      // echo "<td><div class='clearfix'><button type='submit'  class='login_submit' name='admin_update' value='update'>Update</button></div></td>";
      echo "<td><div class='clearfix_button'><a href='user_delete.php?id=".$r['userId']."'>Delete</a></div></td>";
      echo "</tr>";
    }
    echo "
        </table>";
  ?>
  </div>
    </form>
</div>

<div id="Product_cat" class="tabcontent">
<h2>Product Categories</h2>
<form action="insert_productcat.php">
    <div class='clearfix'><button type='submit'  class='login_submit' name='add_new' value='update'>Add new Product Category</button></div>
    </form>
  <form action="admin_panel.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
  <?php
  $Admin = "product_category";
  $admin = result($Admin) ;
  echo "
  <table>
<tr>
<th>Category ID</th>
<th>Category Name</th>
<th></th>
        </tr>";

    foreach ($admin as $r) {
      echo "<tr>";
      echo "<td>" . $r['categoryId'] . "</td>";
      echo "<td>" . $r['categoryName'] . "</td>";
      echo "<td><div class='clearfix_button'><a href='productcat_update.php?id=".$r['categoryId']."'>Update</a></div></td>";
      // echo "<td><div class='clearfix'><button type='submit'  class='login_submit' name='delete' value='delete'>Delete</button></div></td>";
      echo "</tr>";
    }
    echo "
        </table>";
  ?>
  </div>
    </form>
</div>

<div id="Product" class="tabcontent">
<h2>Products</h2>
<form action="insert_product.php">
    <div class='clearfix'><button type='submit'  class='login_submit' name='add_new' value='update'>Add new product</button></div>
    </form>
  <form action="admin_panel.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
  <?php
  $Admin = "product_master";
  $admin = result($Admin) ;
  echo "
  <table>
<tr>
<th>Product ID</th>
<th>Product Name</th>
<th>Model</th>
<th>Price</th>
<th>Discounted Price</th>
<!-- <th>Short Description</th>
<th>Description</th>
<th>Over View</th>
<th>Features</th>
<th>Additional Info</th>
<th>Warranty</th> -->
<th></th>
<th></th>
        </tr>";

    foreach ($admin as $r) {
      $id= $r['productId'];
      echo "<tr>";
      echo "<td>" . $r['productId'] . "</td>";
      echo "<td>" . $r['productName'] . "</td>";
      echo "<td>" . $r['productModel'] . "</td>";
      echo "<td>" . $r['productPrice'] . "</td>";
      echo "<td>" . $r['discountPrice'] . "</td>";
      // echo "<td>" . $r['productShortDes'] . "</td>";
      // echo "<td>" . $r['productDescription'] . "</td>";
      // echo "<td>" . $r['productOverview'] . "</td>";
      // echo "<td>" . $r['productFeatures'] . "</td>";
      // echo "<td>" . $r['productAdditionalInfo'] . "</td>";
      // echo "<td>" . $r['productWarranty'] . "</td>";
      // echo "<input type='hidden' name='id' value=".$r['productId']."></input>";
      echo "<td><div class='clearfix_button'><a href='product_update.php?id=".$r['productId']."'>Update</a></div></td>";
      echo "<td><div class='clearfix_button'><a href='product_delete.php?id=".$r['productId']."'>Delete</a></div></td>";
      echo "</tr>";
    }
    echo "
        </table>";
    

  ?>
  </div>
    </form>
</div>

<div id="Order" class="tabcontent">
<h2>Messages</h2>
<!-- <form action="insert_admin.php">
    <div class='clearfix'><button type='submit'  class='login_submit' name='add_new' value='update'>Add new Admin</button></div>
    </form> -->
  <form action="admin_panel.php" style="border:1px solid #ccc" class="login_form" method="POST">
      <div class="container_SI">
  <?php
  $Admin = "conatct_form";
  $admin = result($Admin) ;
  echo "
  <table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone Number</th>
<th>Message</th>
        </tr>";
    foreach ($admin as $r) {
      echo "<tr>";
      echo "<td>" . $r['id'] . "</td>";
      echo "<td>" . $r['name'] . "</td>";
      echo "<td>" . $r['email'] . "</td>";
      echo "<td>" . $r['phoneno'] . "</td>";
      echo "<td>" . $r['message'] . "</td>";
      echo "</tr>";
    }
    echo "
        </table>";
  ?>
  </div>
    </form>
</div>

<div id="Logout" class="tabcontent">
<div class="login">
<form method="POST" style="border:1px solid #ccc" class="login_form" action="adminlogout.php">
<H2> Do you want to Logout? </h2>
<button type="submit" class="login_submit" name="delete" > Logout </button>
<!-- <button type="submit" class="login_submit" name="cancle" > Cancle </button> -->
</form>
</div>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
</body>
</html>