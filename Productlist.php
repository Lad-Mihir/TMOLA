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
        <div class="page_location">Products => Mobiles</div>
        <div class="search_option">
            <form class="search_list_page" action="">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit" value="Submit">Search</button>
            </form>
        </div>
        <div class="Filter_form">
            <form action="" method="get">
                <legend>Filter products:</legend><br>
                <div class="type" style="width:400px;">
                    <select>
                        <option value="0">Select type:</option>
                        <option value="1">Mobiles</option>
                        <option value="2">TV</option>
                        <option value="3">Laptop</option>
                    </select><br><br>
                    <select>
                        <option value="0">Select Brand:</option>
                        <option value="1">Samsung</option>
                        <option value="2">LG</option>
                        <option value="3">Apple</option>
                    </select><br><br>
                    <select>
                        <option value="0">Select color:</option>
                        <option value="1">red</option>
                        <option value="2">black</option>
                        <option value="3">gray</option>
                        <option value="3">green</option>
                    </select><br><br>
                    <button type="submit" value="Submit">
                        <label for="submit">Submit</label>
                        &nbsp;&nbsp;&nbsp;<button type="reset" value="Reset">
                            <label for="Reset">Reset</label>
                </div>
                <br><br>
                <div class="var_ad">
                    <img src="Assets/Homepage/6.jpg" style="width:80%; height:85%">
                </div>
            </form>
        </div>
        <div class="Product_list_dis">
            <div class="product_row">
                <div class="product_column">
                    <div class="card">
                        <a href="productdetail.php">
                            <img src="Assets/Homepage/6.jpg" alt="Denim Jeans" style="width:100%">
                            <h4>Tailored Jeans</h4>
                            <p class="price">$19.99</p>
                            <p>Some text about the jeans.</p>
                            <p><button action>Add to Cart</button></p>
                        </a>
                    </div>
                </div>
                <div class="product_column">
                    <div class="card">
                        <a href="productdetail.php">
                            <img src="Assets/Homepage/8.jpg" alt="Denim Jeans">
                            <h4>Tailored Jeans</h4>
                            <p class="price">$19.99</p>
                            <p>Some text about the jeans.</p>
                            <p><button>Add to Cart</button></p>
                        </a>
                    </div>
                </div>
                <div class="product_column">
                    <div class="card">
                        <a href="productdetail.php">
                            <img src="Assets/Homepage/7.jpg" alt="Denim Jeans">
                            <h4>Tailored Jeans</h4>
                            <p class="price">$19.99</p>
                            <p>Some text about the jeans.</p>
                            <p><button>Add to Cart</button></p>
                        </a>
                    </div>
                </div>
                <div class="product_column">
                    <div class="card">
                        <a href="productdetail.php">
                            <img src="Assets/Homepage/5.jpg" alt="Denim Jeans">
                            <h4>Tailored Jeans</h4>
                            <p class="price">$19.99</p>
                            <p>Some text about the jeans.</p>
                            <p><button>Add to Cart</button></p>
                        </a>
                    </div>
                </div>
                <div class="product_column">
                    <div class="card">
                        <a href="productdetail.php">
                            <img src="Assets/Homepage/5.jpg" alt="Denim Jeans">
                            <h4>Tailored Jeans</h4>
                            <p class="price">$19.99</p>
                            <p>Some text about the jeans.</p>
                            <p><button>Add to Cart</button></p>
                        </a>
                    </div>
                </div>
                <div class="product_column">
                    <div class="card">
                        <a href="productdetail.php">
                            <img src="Assets/Homepage/5.jpg" alt="Denim Jeans">
                            <h4>Tailored Jeans</h4>
                            <p class="price">$19.99</p>
                            <p>Some text about the jeans.</p>
                            <p><button>Add to Cart</button></p>
                        </a>
                    </div>
                </div>
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