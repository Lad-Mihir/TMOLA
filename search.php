<!-- <?php
require("dbcont.php");
$userid;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pName = $_GET['a'];
$pDesc = $_GET['b'];
$pRating = $_GET['c'];
$pPrice = $_GET['d'];
$dPrice = $_GET['e'];




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
$sql = "SELECT * FROM product_master WHERE productName LIKE '%$pName%' OR productDescription LIKE '%$pDesc%' OR productRating LIKE '%$pRating%' OR productPrice LIKE '%$pPrice%' OR discountPrice LIKE '%$dPrice%'";
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
/* $pName = "";
$pDesc = "";
$pRating = "";
$pPrice = "";
$dPrice = "";
if (isset($_GET['search'])) {
$pName = $_GET['productName'];
$pDesc = $_GET['productDescription'];
$pRating = $_GET['productRating'];
$pPrice = $_GET['productPrice'];
$dPrice = $_GET['discountPrice'];
header("location:Search.php?a=$pName&b=$pDesc&c=$pRating&d=$pPrice&e=$dPrice");
} */

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
    <img src="Assets/Homepage/1.jpg" style="width:100%; height:200px">
</div>
<section class="product_list">

    <div class="search_option">
        <form class="search_list_page" action="">
            <input type="text" placeholder="Search.." name="_search">
            <button type="submit" value="Submit">Search</button>
        </form>
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
                        <img src=" <?php
                                echo $n[7]; ?>" alt="<?php
                                  echo $n[3]; ?>" style="width:100%">
                        <h4>
                            <?php
                                    echo $n[3]; ?>
                        </h4>
                        <p class="price">
                            <?php
                                    echo $n[4];
                                    ; ?>
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

</html> -->