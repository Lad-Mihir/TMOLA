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
<div class="hor_ad">
<img src="Assets/Homepage/1.jpg" style="width:100%; height:200px">
</div>
<section class="product_detail">
    <div class="page_location1">Products => Mobiles</div>
    <div class="search_option1">
        <form class="search_list_page" action="">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit" value="Submit">Search</button>
        </form>
    </div>
    <div class="pro_img">
    <div class="container_pro_detail">
        <img id="expandedImg" style="width:100%" src="Assets/Homepage/7.jpg">
    </div><br>
    <div class="row_pro_detail">
        <div class="column_pro_detail">
            <img src="Assets/Homepage/6.jpg" alt="Nature" style="width:100%" onclick="myFunction(this);">
        </div>
        <div class="column_pro_detail">
            <img src="Assets/Homepage/8.jpg" alt="Snow" style="width:100%" onclick="myFunction(this);">
        </div>
        <div class="column_pro_detail">
            <img src="Assets/Homepage/7.jpg" alt="Mountains" style="width:100%" onclick="myFunction(this);">
        </div>
    </div>
    </div>
    <div class="pro_details">
        <p><strong>SAMSUNG S23 Ulra</strong> | model number 12510250
            loren ipsum Lorem Ipsum </p>

        <hr>
        <h4>Product rating:</h4>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud
            exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat. orem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua. Ut enim ad minim veniam, quis nostrud
            exercitation ullamco laboris nisi ut aliquip ex ea
            commodo consequat.
        </p>
        <span class="Old_price" style="font-size: 1em;">Price</span><br>
        <span class="dis_price" style="font-size: 1.2em;">Price2</span>
        <br><br>
        <div class="container">
            <!-- adding button and heading to show the digits -->
            <!-- increment() and decrement() functions on button click-->
            <button onclick="decrement()" class="pro_cont_btn_de">-</button>
            <span id="counting"></span>
            <button onclick="increment()" class="pro_cont_btn_in">+</button>
        </div><br>
        <button class="addtocart">
            <div class="pretext">
                <i class="fas fa-cart-plus"></i> ADD TO CART
            </div>

            <div class="pretext done">
                <div class="posttext"><i class="fas fa-check"></i> ADDED</div>
            </div>

        </button>
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
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam dignissimos beatae aliquam quis quae fugiat recusandae reprehenderit sint, maxime, nihil, repudiandae labore aliquid. Eos vitae magni assumenda alias atque quidem.</p>
        </div>

        <div id="Features" class="tabcontent">
            <h3>Features</h3>
            <table>
                <tr>
                    <td>Operating system</td>
                    <td>Android 13</td>
                </tr>
                <tr>
                    <td>Cellular Network Provider Compatibility</td>
                    <td> Bell Mobility / Virgin Plus</td>
                </tr>
                <tr>
                    <td>Cellular Network Type</td>
                    <td> 5G+, 5G, LTE Advanced</td>
                </tr>
                <tr>
                    <td>Cellular Frequencies</td>
                    <td> LTE</td>
                </tr>
            </table>

        </div>

        <div id="What" class="tabcontent">
            <h3>What's included</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officiis ullam. Aut consequatur velit sequi, iste nesciunt blanditiis earum eos quibusdam minima, perspiciatis tempora nostrum quisquam reprehenderit explicabo soluta totam.</p>
        </div>
        <div id="Warranty" class="tabcontent">
            <h3>Warranty</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, officiis ullam. Aut consequatur velit sequi, iste nesciunt blanditiis earum eos quibusdam minima, perspiciatis tempora nostrum quisquam reprehenderit explicabo soluta totam.</p>
        </div>
    </div>
    <div class="cus_review">
        <h2>Customre's review</h2>
        <h3>Mihir lad</h3>
        <p>@mihir_lad</p>
        <sapn style="font-size: 1em;">Product rating:</h4>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum sunt consectetur fugit illo nostrum esse ut voluptatibus impedit facilis adipisci laudantium, deserunt, animi doloremque magnam quia, repudiandae explicabo. Similique, totam.</p>
    </div>
    <div class="review_pro">
        <h2>Review this product</h2>
        <p>Give start based on your experience.
            <span style="font-size: 0.7em"> star for best performance.<br>
                1 star for poor performance.</span>
        </p>
        <p>Rating:</p>
        <input type="range" name="rangeInput" min="0" max="5" value="0.5" onchange="updateTextInput(this.value);">
        <input type="text" id="textInput" value="">
        <p>Comment:</p>
        <input type="text" class="comment" name="comment" style="height: 100px; width:400px"><br><br>
        <button type="Submit">Submit</button>

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

    var data = 0;

    //printing default value of data that is 0 in h2 tag
    document.getElementById("counting").innerText = data;

    //creation of increment function
    function increment() {
        data = data + 1;
        document.getElementById("counting").innerText = data;
    }
    //creation of decrement function
    function decrement() {
        data = data - 1;
        document.getElementById("counting").innerText = data;
    }
    const button = document.querySelector(".addtocart");
    const done = document.querySelector(".done");
    console.log(button);
    let added = false;
    button.addEventListener('click', () => {
        if (added) {
            done.style.transform = "translate(-110%) skew(-40deg)";
            added = false;
        } else {
            done.style.transform = "translate(0px)";
            added = true;
        }

    });

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