<?php
require("dbcont.php");
//sessions
$userid;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['userId'])) {
    $userid = $_SESSION['userId'];
}
if (empty($userid)) {
    $message = "Please <a href='signin.php'>Sign In</a> to your account. Thank you.";
}
if(isset($_GET['q'])) {
    $q = $_GET['q'];
}

$pid = $_GET['pid'];

//for dispalying the product details
$Mobile = "SELECT * FROM product_master where productId = $pid ";
//$result = $conn->query($sql);
$query_run5 = mysqli_query($conn, $Mobile);
if ($query_run5->num_rows > 0) {
    foreach ($query_run5 as $row) {
        $dbproductId = $row["productId"];
        $dbcategoryId = $row["categoryId"];
        $dbdiscountId = $row["discountId"];
        $dproductName = $row["productName"];
        $dbproductPrice = $row["productPrice"];
        $dbproductQuality = $row["productQuality"];
        $dbproductQuantity = $row["productQuantity"];
        $dbproductImage1 = $row["ProductImages1"];
        $dbproductshort = $row["productShortDes"];
        $dbproductModel = $row["productModel"];
        $dbproductImage2 = $row["ProductImages2"];
        $dbproductImage3 = $row["ProductImages3"];
        $dbproductrating = $row["productRating"];
        $dbproductDes = $row["productDescription"];
        $dbproductOverview = $row["productOverview"];
        $dbproductFeatures = $row["productFeatures"];
        $dbproductAddinfo = $row["productAdditionalInfo"];
        $dbproductWrranty = $row["productWarranty"];
        $dbproductDPrice = $row["discountPrice"];
    }
}

//For add to cart button and push value to the DB.
$Error = [];
$cmessage = "";
$tprice = "";
$num = "";
if (isset($_GET['addtocart'])) {
    $num = $_GET['num'];
    if(isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    } else {
        $ma = "Please sign in to your account before order!";
        header("Location:signin.php?m=".$ma);
    }
    $pid = $_GET['pid'];
    $Dprice = $_GET['dprice'];
    $price = $_GET['price'];
    if ($Dprice==0) {
        $tprice = intval($num) * intval($price);
    //    $tprice = strval($tprice1);
    } else {
        $tprice = intval($num) * floatval($Dprice);
        // $tprice = strval($tprice1);
    }
    $Pstatus = $_GET['Pstatus'];
    //sanitizing the errors...
    if (!empty($num) & $num > 0) {
        $num = mysqli_real_escape_string($conn, trim($num));
    } else {
        array_push($Error, "Please select your order quantity greater than zero.<br>");
    }
    if (!empty($Error)) {
        foreach ($Error as $e) {
            $m = $e;
        }
    } else {

        $osql = "SELECT * from order_item where userId = $uid and paymentStatus = '0' and productId = $pid;";
        $query_run6 = mysqli_query($conn, $osql);
        if (!$query_run6) {
            die('Error in SELECT query: ' . mysqli_error($conn));
        }
        if ($query_run6->num_rows > 0) {
            $row = mysqli_fetch_assoc($query_run6);
            $oid = $row["orderId"];
            $usql = "UPDATE order_item set `orderQuantity` = $num , `orderTotalpayment` = $tprice where orderId = $oid;";
            $update_result = mysqli_query($conn, $usql);
            if (!$update_result) {
                die('Error in UPDATE query: ' . mysqli_error($conn));
            }
            header("Location:cart.php");
        } else {
            if(!empty($pid)) {
                $sql = "INSERT INTO `order_item` (`productId`, `userId` , `orderQuantity`, `orderTotalpayment`, `paymentStatus`) VALUES (?,?,?,?,?);";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sssds',$pid, $uid, $num, $tprice, $Pstatus);
                $insert_result = mysqli_stmt_execute($stmt);
                if (!$insert_result) {
                    die('Error in INSERT query: ' . mysqli_error($conn));
                }
                $cmessage = "successful!";
                header("Location:cart.php");
            } 
        }
}
}
// echo gettype($num);
// $num1 = intval($num);
// echo gettype($num1);
// echo $num;
// echo $num1;
// echo gettype($tprice);
// echo $tprice;
// $t= intval($Dprice);
// echo $t;
// $p= intval($price);
// echo $p;

//For getting the review from the user about the perticular product.
if (isset($_POST['submit'])) {
    if (empty($userid)) {
    echo "<script>alert('Please <a href='SignIn.php'>Sign In</a> to your account. Thank you.')</script>";
        header("location:productdetail.php?pid=$pid");
} else {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    //validation...
    if (!empty($rating)) {
        $rating = mysqli_real_escape_string($conn, trim($rating));
    } else {
        array_push($Error, "Please enter rating.<br>");
    }
    if (!empty($comment)) {
        $comment = mysqli_real_escape_string($conn, trim($comment));
    } else {
        array_push($Error, "Please enter comment.<br>");
    }
    //checking if error is there....
    if (!empty($Error)) {
        foreach ($Error as $error) {
            $message = $error;
        }
    } else {
        //inserting the values to the DB.
        $sql = "INSERT INTO people_review (`reviewRating`,`reviewComment`,`userId`, `productId`) VALUES (?,?,?,?);";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $rating, $comment, $userid, $pid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == 1) {
            $message = "Your review submitted sucessful!";
        } else {
            $message = "ohh! Error in submitting review. Please try again.";
        }
    }
}
}
//For displaying the review about the product.
$review_message = "";
$sql = "SELECT reviewId FROM people_review where productId=$pid;";
$rid = mysqli_query($conn, $sql);
if (mysqli_num_rows($rid) > 0) {
    //create an empty array to store the column values
    $rids = array();
} else {
    $review_message = "Be the first to give review about this product!!";
}

//loop through the result set and store the column values in the array
while ($row = mysqli_fetch_assoc($rid)) {
    $rids[] = $row['reviewId'];
}

function user_details($id)
{
    $conn = mysqli_connect(Server, Username, Password, DatabaseName);
    $sql =  "SELECT user_master.userFname as Fname, user_master.userName as userName, people_review.reviewRating as rating, people_review.reviewComment as ucomment, people_review.userId as userId FROM people_review INNER JOIN user_master ON people_review.userId=user_master.userId where people_review.reviewId='$id';";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $userFname = $user['Fname'];
    $userName = $user['userName'];
    $rating = $user['rating'];
    $comment = $user['ucomment'];
    $det = array($userFname, $userName, $rating, $comment);
    return $det;
}

$star=[];
if (!empty($review_message)) {
       $starrating = "No reviews yet!!";
} else {
    foreach ($rids as $id) {
        $r = user_details($id);
        $star[] = $r[2];
    }
}
if(count($star)>0) {
$starrating = array_sum($star)/count($star);
}

//getting search value
if(isset($_GET['searchsubmit'])) {
    $d= $_GET['undersearch'];
    header("Location:filterproductlist.php?d=$d");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMOLA- Product</title>
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
    <section class="product_detail">
        <div class="page_location1"></div>
        <div class="search_option1">
            <form class="search_list_page" action="filterproductlist.php" method="get">
                <input type="text" placeholder="Search.." name="undersearch">
                <button type="submit" name="searchsubmit">Search</button>
            </form>
        </div>
        <div class="pro_img">
            <div class="container_pro_detail">
                <img id="expandedImg" style="width:100%" src="<?php echo $dbproductImage1; ?>">
            </div><br>
            <div class="row_pro_detail">
                <div class="column_pro_detail">
                    <img src="<?php echo $dbproductImage1; ?>" alt="Nature" style="width:100%" onclick="myFunction(this);">
                </div>
                <div class="column_pro_detail">
                    <img src="<?php echo $dbproductImage2; ?>" alt="Snow" style="width:100%" onclick="myFunction(this);">
                </div>
                <div class="column_pro_detail">
                    <img src="<?php echo $dbproductImage3; ?>" alt="Mountains" style="width:100%" onclick="myFunction(this);">
                </div>
            </div>
        </div>
        <div class="pro_details">
            <p><strong><?php echo "$dproductName" ?></strong> | <?php echo "$dbproductModel" ?>
            </p>

            <hr>
            <h4>Product rating:&nbsp; <?php echo $starrating; ?> </h4> 
            <p>
                <?php echo "$dbproductDes" ?>
            </p>
            <?php
            if (!empty($dbproductDPrice)) { 
                if($dbproductDPrice== "0") {?>
                <span class="dis_price" style="font-size: 1.2em;">CAD$&nbsp;<?php echo "$dbproductPrice" ?></span>
                
            <?php } else { ?>
                <span class="Old_price" style="font-size: 1em; text-decoration:line-through; color:red;">CAD$&nbsp;<?php echo "$dbproductPrice" ?></span><br>
                <span class="dis_price" style="font-size: 1.2em;">CAD$&nbsp;<?php echo "$dbproductDPrice" ?></span>
            <?php } } else { ?>
                <span class="dis_price" style="font-size: 1.2em;">CAD$&nbsp;<?php echo "$dbproductPrice" ?></span>
            <?php } ?>
            <br><br>
            <form action="productdetail.php?pid=<?php echo $pid; ?>" method="GET">
                <?php
                if (!empty($cmessage)) {
                    echo $cmessage;
                }
                if (!empty($m)) {
                    echo $m;
                }
                ?>
                <!-- <div class="container"> -->
                    <!-- adding button and heading to show the digits -->
                    <!-- increment() and decrement() functions on button click-->
                    <!-- <button onclick="decrement()" class="pro_cont_btn_de">-</button> -->
                    <label for="num"><strong>Quantity:</strong></label>
                    <input type="number" name="num" style="width:50px; border:2px black soild;" value="<?php echo $q;?>"></input>
                    <!-- <button onclick="increment()" class="pro_cont_btn_in">+</button> -->
                <!-- </div>-->
                <br><br>
                <input type="hidden" name="pid" value="<?php echo $pid;  ?>">
                <input type="hidden" name="uid" value="<?php echo $userid; ?>" />
                <input type="hidden" name="dprice" value="<?php echo $dbproductDPrice; ?>" />
                <input type="hidden" name="price" value="<?php echo $dbproductPrice; ?>" />
                <input type="hidden" name="Pstatus" value="0" />
                <button type="submit" class="login_submit" name="addtocart" style="width:150px;">Add to Cart
                    <!-- <div class="pretext">
                <i class="fas fa-cart-plus"></i> ADD TO CART
            </div>

            <div class="pretext done">
                <div class="posttext"><i class="fas fa-check"></i> ADDED</div>
            </div> -->

                </button>
            </form>
        </div>
        <div class="more_info">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Overview')">Overview</button>
                <button class="tablinks" onclick="openCity(event, 'Features')">Features</button>
                <button class="tablinks" onclick="openCity(event, 'What')">What's included</button>
                <button class="tablinks" onclick="openCity(event, 'Warranty')">Warranty</button>
            </div>

            <div id="Overview" class="tabcontent" style="display:block;">
                <h3>Overview</h3>
                <p><?php echo "$dbproductOverview" ?></p>
            </div>

            <div id="Features" class="tabcontent">
                <h3>Features</h3>
                <?php echo "$dbproductFeatures" ?>

            </div>

            <div id="What" class="tabcontent">
                <h3>What's included</h3>
                <p><?php echo "$dbproductAddinfo" ?></p>
            </div>
            <div id="Warranty" class="tabcontent">
                <h3>Warranty</h3>
                <p><?php echo "$dbproductWrranty" ?></p>
            </div>
        </div>
        <div class="cus_review">
            <h2>Customre's review</h2>
            <?php
            // print_r($rids);
            if (!empty($review_message)) {
                echo $review_message;
            } else {
                foreach ($rids as $id) {
                    $r = user_details($id);
            ?>
                    <h3><?php echo $r[0]; ?></h3>
                    <p>@<?php echo $r[1]; ?></p>
                    <sapn style="font-size: 1em;">Product rating:</h4>
                        <?php echo $r[2]; ?>
                        <p><?php echo $r[3]; ?></p>
                        <hr>
                <?php }
            } ?>
        </div>
        <!-- for geting the review from the user-->
        <div class="review_pro">
            <form action="productdetail.php?pid=<?php echo $pid; ?>" style="padding-left:20px; border:none;" class="login_form" method="POST">
                <h2>Review this product</h2>
                <span style="color:red;"><?php if (!empty($message)) {
                                                echo $message;
                                            }
                                            ?></span>
                <p>Give start based on your experience.<br>
                    <span style="font-size: 0.7em"> 5 star for best performance.<br>
                        1 star for poor performance.</span>
                </p>
                <lable for="rangeInput">Rating:</lable>
                <input type="range" name="rangeInput" min="0" max="5" value="0.5" onchange="updateTextInput(this.value);">
                <input type="text" id="textInput" value="" name="rating">
                <lable for="comment">Comment:</lable><br>
                <textarea class="comment" name="comment" rows="5" cols="50"></textarea><br><br>
                <div class="clearfix">
                    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                    <button type="submit" class="login_submit" name="submit" style="width:150px;">Submit</button>
                </div>
            </form>

        </div>

    </section>

    <script>
        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
            expandImg.parentElement.style.display = "block";
        }

        // function magnify(imgID, zoom) {
        //     var img, glass, w, h, bw;
        //     img = document.getElementById(imgID);
        //     /*create magnifier glass:*/
        //     glass = document.createElement("DIV");
        //     glass.setAttribute("class", "img-magnifier-glass");
        //     /*insert magnifier glass:*/
        //     img.parentElement.insertBefore(glass, img);
        //     /*set background properties for the magnifier glass:*/
        //     glass.style.backgroundImage = "url('" + img.src + "')";
        //     glass.style.backgroundRepeat = "no-repeat";
        //     glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
        //     bw = 3;
        //     w = glass.offsetWidth / 2;
        //     h = glass.offsetHeight / 2;
        //     /*execute a function when someone moves the magnifier glass over the image:*/
        //     glass.addEventListener("mousemove", moveMagnifier);
        //     img.addEventListener("mousemove", moveMagnifier);
        //     /*and also for touch screens:*/
        //     glass.addEventListener("touchmove", moveMagnifier);
        //     img.addEventListener("touchmove", moveMagnifier);

        //     function moveMagnifier(e) {
        //         var pos, x, y;
        //         /*prevent any other actions that may occur when moving over the image*/
        //         e.preventDefault();
        //         /*get the cursor's x and y positions:*/
        //         pos = getCursorPos(e);
        //         x = pos.x;
        //         y = pos.y;
        //         /*prevent the magnifier glass from being positioned outside the image:*/
        //         if (x > img.width - (w / zoom)) {
        //             x = img.width - (w / zoom);
        //         }
        //         if (x < w / zoom) {
        //             x = w / zoom;
        //         }
        //         if (y > img.height - (h / zoom)) {
        //             y = img.height - (h / zoom);
        //         }
        //         if (y < h / zoom) {
        //             y = h / zoom;
        //         }
        //         /*set the position of the magnifier glass:*/
        //         glass.style.left = (x - w) + "px";
        //         glass.style.top = (y - h) + "px";
        //         /*display what the magnifier glass "sees":*/
        //         glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
        //     }

        //     function getCursorPos(e) {
        //         var a, x = 0,
        //             y = 0;
        //         e = e || window.event;
        //         /*get the x and y positions of the image:*/
        //         a = img.getBoundingClientRect();
        //         /*calculate the cursor's x and y coordinates, relative to the image:*/
        //         x = e.pageX - a.left;
        //         y = e.pageY - a.top;
        //         /*consider any page scrolling:*/
        //         x = x - window.pageXOffset;
        //         y = y - window.pageYOffset;
        //         return {
        //             x: x,
        //             y: y
        //         };
        //     }
        // }
        // /* Initiate Magnify Function
        // with the id of the image, and the strength of the magnifier glass:*/
        // magnify("expandedImg", 3);

        //initialising a variable name data

        // var data = 0;

        // //printing default value of data that is 0 in h2 tag
        // document.getElementById("counting").innerText = data;

        // //creation of increment function
        // function increment() {
        //     data = data + 1;
        //     document.getElementById("counting").innerText = data;
        // }
        // //creation of decrement function
        // function decrement() {
        //     data = data - 1;
        //     document.getElementById("counting").innerText = data;
        // }
        // const button = document.querySelector(".addtocart");
        // const done = document.querySelector(".done");
        // console.log(button);
        // let added = false;
        // button.addEventListener('click', () => {
        //     if (added) {
        //         done.style.transform = "translate(-110%) skew(-40deg)";
        //         added = false;
        //     } else {
        //         done.style.transform = "translate(0px)";
        //         added = true;
        //     }

        // });

        //for more informaion tabs
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
        //for the rating output
        function updateTextInput(val) {
            document.getElementById('textInput').value = val;
        }
    </script>
</body>
<footer>
    <?php
    include('footer.php');
    ?>
</footer>

</html>