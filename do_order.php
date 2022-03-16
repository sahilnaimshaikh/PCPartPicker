<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: signin.php");
    exit;
}
require "partials/_dbconnect.php";
$showalert = false;
$showerror = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require "partials/_dbconnect.php";
    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $address = $_POST['address'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $payment_type = $_POST['payment_type'];

    $sql = "INSERT INTO `orders` (`name`, `email`, `phone`, `address`, `product`,`quantity`,`payment_type`,`date & time`) VALUES ('$name', '$email', '$phone', '$address', '$product','$quantity','$payment_type', CURRENT_TIMESTAMP)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $showalert = "Order Placed successfully";
        // header("location: index.php");
    } else {
        $showerror = "Sorry ! Couldn't place your order";
        echo"sorry".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="index.js"></script>
    <script src="typed.js"></script>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/5ee8b4ab96.js" crossorigin="anonymous"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/myCart.css">
    <title>Order</title>
</head>

<body>
    <!-- navbar starts here -->
    <?php
    require "partials/nav.php"
    ?>
    <!-- navbar ends here  -->
    <?php

    if ($showalert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success!</strong> ' . $showalert . '
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    if ($showerror) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>oops!</strong> ' . $showerror . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }   ?>
    <!-- SIphp section starts here  -->
    <!-- Cart showing section starts here  -->
    <div class="cartHeading">
        <div class="imageHeading">
            
        </div>
        <div class="itemHeading">
            <h6>Title</h6>
        </div>
        <div class="priceHeading">
            <h6>Price</h6>
        </div>
    </div>
    <div class="divider"></div>
    <div id="myCart">
        
    </div>
    <div class="divider"></div>
    <div class="totalPrice"id="totalPrice">
        <h5 ></h5>
        <h6 ></h6>
        <h5 ></h5>
    </div>



    <!-- Cart showing section ends here  -->

    <div class="container my-4">
        <h1>Order Now</h1>
        <form action="do_order.php" method="POST">
           
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Enter your Address</label>
                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" required rows="3"></textarea>
            </div>
            <br>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Product</label>
                <select class="form-control" name="product" id="exampleFormControlSelect1">
                <?php 
          $sql = "SELECT * FROM `product` ORDER BY `srno.` DESC ";
          $res = mysqli_query($conn,  $sql);

          if (mysqli_num_rows($res) > 0) {
          	while ($product = mysqli_fetch_assoc($res))
			   { 
				  echo"<option>".$product['product_name']."| INR.".$product['price']."|".$product['product_desc']."
                  </option>
                  
             ";
          		
      			}
	}
	  
	  ?>
                    <!-- <option>Locomotive|
                        Men Slim Fit Casual Shirt| INR.879</option> -->
                   
                </select>
            </div><br>
            <label for="exampleFormControlSelect1">Select Quantity</label>
            <select class="form-select" name="quantity" aria-label="Default select example">
                <option selected value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select><br>
            <label for="exampleFormControlSelect1">Select Payment Type</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" required name="payment_type"  value="cash-on-delivery" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Cash-on-Delivery
                </label>
            </div>
    
            <br>
            <button type="submit" class="btn btn-primary">Purchase</button>
        </form>


    </div>

    <!-- footer starts here 
    <footer id="footer" class="textcenter">
        <div id="footertype">
            <span class="type1"></span>
        </div>
    </footer> -->
    <!-- footer ends here  -->


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
    <script src="showCart.js"></script>
</body>
<script>
    // <!-- typedjs for home section starts here  


    var typed = new Typed('.type', {
        strings: ['Welcome to the Fruit World.'],
        //   smartBackspace: true // Default value
        typeSpeed: 90,
        backSpeed: 40,
        loop: true,
        startDelay: 1000
    });


    // typed.js for home section ends here 


    // typedjs for footer stsrts here  -->

    var typed = new Typed('.type1', {
        strings: ['@Copy YourKart, All Right Reserved.', 'Website Made by Sahil shaikh.'],
        //   smartBackspace: true // Default value
        typeSpeed: 60,
        backSpeed: 60,
        loop: true
        // shuffle: true
    });


    // <!-- typedjs for footer ends here  -->


    /* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
            document.getElementById("footer").style.bottom = "-100px";

        } else {
            document.getElementById("navbar").style.top = "-100px";
            document.getElementById("footer").style.bottom = "0";

        }
        prevScrollpos = currentScrollPos;
    }



    //   code for testimonial slideshow starts here 

    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("testimonial");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndex - 1].style.display = "block";
    }



    // // code for overlay 
    // function on() {
    //   document.getElementById("overlay").style.display = "block";
    // }

    // function off() {
    //   document.getElementById("overlay").style.display = "none";
    // }


    // code for side panel 

    /* Set the width of the sidebar to 250px (show it) */
    function openNav() {
        document.getElementById("mySidepanel").style.width = "100%";
    }

    /* Set the width of the sidebar to 0 (hide it) */
    function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
    }
</script>

</html>