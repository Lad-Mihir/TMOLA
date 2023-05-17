<?php
require("dbcont.php");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$userid;
if (isset($_GET['a'])) {
  $type = $_GET['a'];
} else {
  $type = null;
}
if (isset($_GET['b'])) {
  $brand = $_GET['b'];
} else {
  $brand = null;
}
if (isset($_GET['c'])) {
  $features = $_GET['c'];
} else {
  $features = null;
}
if (isset($_GET['d'])) {
  $d = $_GET['d'];
  $q = "SELECT product_master.productId from product_master join product_category on product_master.categoryId = product_category.categoryId where product_master.productName like '%$d%' or product_master.productFeatures like '%$d%' or product_master.productOverview like '%$d%' or product_master.productAdditionalinfo like '%$d%' or product_master.productWarranty like '%$d%'  or product_master.productModel like '%$d%'  or product_master.productShortDes like '%$d%'  or product_master.productDescription like '%$d%';";

} else {
  $d = null;
  $q = "SELECT productId FROM product_master where categoryID= '$type' or productName = '$brand' or productFeatures = '$features';";
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


$conn = mysqli_connect(Server, Username, Password, DatabaseName);
$sql = $q;
// $sql = "SELECT product_master.productId from product_master join product_category on product_master.categoryId = product_category.categoryId where product_master.productName like '%$d%' or product_master.productFeatures like '%$d%' or product_master.productOverview like '%$d%' or product_master.productAdditionalinfo like '%$d%' or product_master.productWarranty like '%$d%'  or product_master.productModel like '%$d%'  or product_master.productShortDes like '%$d%'  or product_master.productDescription like '%$d%';";
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


$type = "";
$brand = "";
$feature = "";
//fatching the filter data...
if (isset($_GET['filter'])) {
  $type = $_GET['type'];
  $brand = $_GET['brand'];
  $features = $_GET['feature'];

  header("location:filterproductlist.php?a=$type&b=$brand&c=$features");
}
// retrice all the data from  databse for filter option

$sql = "SELECT distinct productName FROM product_master;";
$result = mysqli_query($conn, $sql);

// Generate the <option> elements for the "type" field
$options = '';

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $row['productName'] . '">' . $row['productName'] . '</option>';
    // $options1 .= '<option value="' . $row['productFeatures'] . '">' . $row['productFeatures'] . '</option>';
  }
}
$fsql = "SELECT distinct productFeatures FROM product_master;";
$fresult = mysqli_query($conn, $fsql);

// Generate the <option> elements for the "type" field

$options1 = '';
if (mysqli_num_rows($fresult) > 0) {
  while ($row = mysqli_fetch_assoc($fresult)) {
    // $options .= '<option value="' . $row['productName'] . '">' . $row['productName'] . '</option>';
    $options1 .= '<option value="' . $row['productFeatures'] . '">' . $row['productFeatures'] . '</option>';
  }
}


$csql = "SELECT distinct * FROM product_category;";
$cresult = mysqli_query($conn, $csql);
$cat = mysqli_fetch_assoc($cresult);
// Generate the <option> elements for the "category" field
$options3 = '';
if (mysqli_num_rows($cresult) > 0) {
  while ($crow = mysqli_fetch_assoc($cresult)) {
    $options3 .= '<option value="' . $crow['categoryId'] . '">' . $crow['categoryName'] . '</option>';
  }
}

//getting search value
if (isset($_GET['searchsubmit'])) {
  $d = $_GET['undersearch'];
  header("Location:filterproductlist.php?d=$d");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TMOLA- Product List</title>
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
    <img src="Assets/Homepage/9.jpg" style="width:100%; height:200px">
  </div>
  <section class="product_list">

    <div class="search_option">
      <form class="search_list_page" action="filterproductlist.php" method="get">
        <input type="text" placeholder="Search.." name="undersearch">
        <button type="submit" name="searchsubmit">Search</button>
      </form>
    </div>
    <div class="Filter_form">
      <form action="" method="get">
        <legend>Filter products:</legend><br>
        <div class="type" style="width:400px;">
          <select name="type">
            <option value="">Select type:</option>
            <?php echo $options3; ?>
          </select><br><br>
        </div>
        <div class="type" style="width:400px;">
          <select name="brand">
            <option value="">Select Name of Product:</option>
            <?php echo $options; ?>
          </select><br><br>
        </div>
        <div class="type" style="width:400px;">
          <select name="feature">
            <option value="">Select Feature:</option>
            <?php echo $options1; ?>
          </select><br><br>
        </div>
        <!-- <select>
                        <option value="0">Select color:</option>
                        <option value="1">red</option>
                        <option value="2">black</option>
                        <option value="3">gray</option>
                        <option value="3">green</option>
                    </select><br><br> -->
        <button type="submit" value="Submit" name="filter">
          Submit</button>
        <!-- &nbsp;&nbsp;&nbsp;<button type="reset" value="Reset">
                            <label for="Reset">Reset</label> -->
      </form>
      <br><br>
      <div class="var_ad">
        <img src="Assets/Homepage/6.jpg" style="width:80%; height:100%">
      </div>

    </div>
    <div class="Product_list_dis">
      <div class="product_row">
        <?php
        if (!empty($pid)) {
          foreach ($pid as $value) {

            $n = product_card($value); ?>
            <div class="product_column">
              <div class="card">
                <a href="productdetail.php?pid=<?php echo $n[0]; ?>">
                  <img src="<?php
                            echo $n[7]; ?>" alt="<?php
                                        echo $n[3]; ?>" style="width:100%">
                  <h4>
                    <?php
                    echo $n[3]; ?>
                  </h4>
                  <p class="price">
                    <?php
                    echo $n[4];; ?>
                  </p>
                  <p>
                    <?php
                    echo $n[8]; ?>
                  </p>
                  <p><button action>Add to Cart</button></p>
                </a>
              </div>
            </div>
            
        <?php }
        } else {
          echo "Please select other option.";
        }
        ?>
      </div>
    </div>
  </section>
</body>
<footer>
  <?php
  include('footer.php');
  ?>
</footer>

</html>