<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
include 'data.php'; 

// Get the product ID from the query parameter
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch detailed information about the product
$query = "SELECT * FROM product WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
    // Handle the case where no data is found for the given product ID
    $product = null;
}

// Close the prepared statement
mysqli_stmt_close($stmt);

// Calculate the deadline (6 hours from now)
$deadline = time() + (6 * 60 * 60); // 6 hours in seconds
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mad_Cat">
    <link rel="shortcut icon" href="image/logo.png">
    <title><?php echo $product['product_name']; ?> Detail's</title>
    <style>
        * {
        box-sizing: border-box;
        }

        /* Your existing CSS styles */
        .p1 {
        width: 730px; /* Adjust this width as needed */
        height: auto;
        padding: 6px; /* Add padding to all sides */
        font-size: 16px;
        line-height: 1.6;
        color: #aaa;
        margin: 3px 0;
        text-align: justify;
        overflow: auto; /* Add overflow property to enable scrolling if content exceeds height */
        max-height: 800px; /* Define a max-height to limit the expansion of the product description */
        }

        .wrapper {
            display: relative;
            justify-content: center;
            align-items: flex-start; /* Change from center to flex-start */
            font-family: Montserrat;
            background: #3b5d50;
            width: auto;
            margin-top: -120px;
        }

        .outer {
            position: relative;
            background: #3b5d50;
            height: 553px;
            width: auto;
            /* overflow: hidden; */
            display: flex;
            align-items: center;
        }

        .img1 {
            position: absolute;
            top: 0px;
            right: -678px;
            z-index: 0;
            animation-delay: 0.9s;
            max-width: 100%; /* Set the maximum width to 100% */
        }

        .content {
            animation-delay: 0.6s;
            position: absolute;
            /* top: 20px;
            left: 20px; */
            bottom:0px;
            z-index: 0;
        }

        h1,h4 {
            margin-bottom: 0;
            color: #111;
            font-size: 60px;
            padding: 6px;
        }

        .bg {
            position: absolute;
            top: 0;
            left: 0;
            display: inline-block;
            color: #fff;
            background: cornflowerblue;
            padding: 1px 9px;
            border-radius: 60px;
            font-size: .7em;
            font-weight: bold;
            margin-bottom: 63px;
            z-index: 1; /* Ensure the tag is above other elements */
        }

        .button {
            width: fit-content;
            height: fit-content;
            margin: 13px;
        }

        .button a {
            display: inline-block;
            overflow: hidden;
            position: relative;
            font-size: 17px;
            color: white;
            text-decoration: none;
            padding: 9px 15px;
            border: 1px solid white;
            font-weight: bold;
        }

        .button a:after{
            content: "";
            position: absolute;
            top: 0;
            right: -10px;
            width: 0%;
            background:  white;
            height: 100%;
            z-index: -1;
            transition: width 0.6s ease-in-out;
            transform: skew(-25deg);
            transform-origin: right;
        }

        .button a:hover:after {
            width: 150%;
            left: -10px;
            transform-origin: left;
            
        }

        .button a:hover {
            color: #3b5d50;
            transition: all 0.9s ease;
        }


        .button a:nth-of-type(1) {
            border-radius: 50px 0 0 50px;
            border-right: none;
        }

        .button a:nth-of-type(2) {
            border-radius: 0px 60px 50px 0;
        }
        .star-rating {
            font-size: 19px; /* Adjust the size of the stars */
        }

        .star {
            color: gold; /* Default color of the stars */
        }
        .discount-tag{
            position: absolute;
            background: #3b5d50;
            padding: 5px;
            border-radius: 5px;
            color: #fff;
            right: 10px;
            top: 10px;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
                <div class="wrapper">
        <?php if ($product): ?>
            <div class="outer">
                <div class="content animated fadeInLeft" >
                    <span class="bg animated fadeInDown">EXCLUSIVE</span><br>
                    <h1><?php echo $product['product_name']; ?></h1>
                    <div class="star-rating">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <!-- <span class="star" data-value="5">&#9733;</span> -->
                        <b>(568)</b>
                    </div>
                    <p><span style="color: red;"><?php echo $product['product_Discount']; ?>% OFF</span></p>
                    <!-- Countdown Timer -->
                    <p id="countdown" style="color: #add8e6 ;">
                    <i class="bi bi-truck"></i> <!--shipping icon -->
                    <b><i>Order within the next 6 hours to get fast delivery for free!</i></b> </br>
                    <b>(Countdown: <span id="hours"></span>h <span id="minutes"></span>m <span id="seconds"></span>s)</b>
                    </p>
                    <h4><b><?php echo $product['product_Category']; ?></b></h4>
                    <p class="p1"><?php echo $product['product_description']; ?>.</p>
                    <div class="button">
                        <a href="#"><s>₹<?php echo $product['product_mrp']; ?></s>&nbsp;&nbsp;
                        <b>₹<?php echo $product['product_sprice']; ?></b></a><a class="cart-btn" href="javascript:void(0);" onclick="addToCart(<?php echo $product['id']; ?>)"><i class="cart-icon ion-bag"></i>ADD TO CART</a>
                    </div>   
                
                    <div class="img1">
                        <img src="image/<?php echo $product['product_images']; ?>" class="animated fadeInRight" style="width: 560px; height: 560px; margin: 139px 0 0 0;">
                    </div>
            
            <?php else: ?>
                <div class="outer">
                    <p>Product not found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<!-- start add Section -->
                <div class="adds">
                <div class="mad3_co-section product-section before-footer-section">
		    <div class="container">
			<div class="row">
                <h2 style="color: #3b5d50;"><b>Similar Products</b></h2><br><br><br><br><br>
                <?php
                    $query = "SELECT * FROM product WHERE is_active = 1 AND id != ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, 'i', $product_id);
                    mysqli_stmt_execute($stmt);
                    $data = mysqli_stmt_get_result($stmt);
                    $result = mysqli_num_rows($data);

                    if ($result) {
                        while ($row = mysqli_fetch_array($data)) {
                            ?>
                            <div class="col-12 col-md-4 mb-5">
                                <a class="product-item" href="product.php?id=<?php echo $row['id']; ?>">
                                    <span class="discount-tag"><?php echo $row['product_Discount']; ?>% off</span>
                                    <img src="image/<?php echo $row['product_images']; ?>" class="img-fluid product-thumbnail" style="width: 250px; height: 250px;">
                                    <h3 class="product-title"><?php echo $row['product_name']; ?></h3>
                                    <strong class="product-price"><s><span style="color:red; font-size: 15px;">₹<?php echo $row['product_mrp']; ?></span></s>&nbsp;&nbsp; <b>₹<?php echo $row['product_sprice']; ?></b></strong>
                                        <span class="icon-cross">
                                        <img src="image/icons/cross.svg" class="img-fluid" >
                                    </span>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
    </div>
    <!-- End add Section -->  

    <!-- Start Footer Section -->
    <?php include 'footer.php'; ?>
    <!-- End Footer Section -->  

    <script>
    // Function to update the countdown timer
    function updateCountdown() {
        // Get the current date and time
        var now = new Date().getTime();
        var deadline = <?php echo $deadline * 1000; ?>;
        
        // Calculate the time remaining until the deadline
        var timeRemaining = deadline - now;
        
        if (timeRemaining > 0) {
            // Calculate hours, minutes, and seconds
            var hours = Math.floor(timeRemaining / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
            
            // Display the countdown
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;
            } else {
                // If the deadline has passed, display a message
                document.getElementById("countdown").innerHTML = "The deadline has passed.";
            }
            }

            // Initial call to update countdown
            updateCountdown();
            
            // Update the countdown every second
            setInterval(updateCountdown, 1000);
        </script>

    <!-- JavaScript to handle Add to Cart functionality -->
    <script>
        // Function to handle Add to Cart click event
        function addToCart(productId) {
            // AJAX request to send product ID to PHP script
            console.log(productId);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_to_cart.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Check if the response from the server indicates success
                    if (xhr.responseText === 'success') {
                        // Redirect to cart.php after adding the product to the cart
                        window.location.href = 'cart.php';
                    } else {
                        // Handle any errors or display appropriate message
                        console.log('Error adding product to cart.');
                    }
                }
            };
            // Send product ID in the request body
            xhr.send('product_id=' + productId);
        }
    </script>
    
</body>
</html>
