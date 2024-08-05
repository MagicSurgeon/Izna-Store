<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}

include 'data.php'; // Include file to fetch product data
$total = 0; // Initialize total variable

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Mad_Cat">
  <link rel="shortcut icon" href="image/logo.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title>Cart</title>
  <style>
		.discount-tag {
			position: absolute;
			background: #3b5d50;
			font-size: 10px;
			padding: 2px;
			border-radius: 30px;
			color: #fff;
			right: 0;
			top: 0;
			transform: translate(100%, 0); /* Move the tag to the right side of the product */
			text-transform: capitalize;
		}
    .product-thumbnail {
        position: relative; /* Ensure the parent container is positioned relatively */
        display: inline-block; /* Ensure proper alignment for child elements */
    }

		/* CSS for quantity button - & + */
    .value-button {
    display: inline-block;
    border: 1px solid #ddd;
    margin: 0px;
    width: 40px;
    height: 40px;
    text-align: center;
    vertical-align: middle;
    padding: 5px 0;
    background: #eee;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border-radius: 50%; /* Make the button circular */
    }

    .value-button:hover {
        cursor: pointer;
    }

    .decrease {
        margin-right: 3px;
        border-radius: 100%;
    }

    .increase {
        margin-left: 3px;
        border-radius: 100%;
    }

    input[type=number] {
        text-align: center;
        border: none;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin: 0px;
        width: 45px;
        height: 47px;
        border-radius: 50%; /* Make the button circular */
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

	</style>

</head>
<body>
  <!-- Start Header/Navigation -->
  <?php include 'header.php'; ?>
  <!-- End Header/Navigation -->

  <!-- Start Hero Section -->
  <div class="hero">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="intro-excerpt">
            <h1>Cart</h1>
            <p>"Hurry! Your curated treasures await. Act now and make them yours before they're gone!"</p>
          </div>
        </div>
        <div class="col-lg-7">
          <!-- <div class="hero-img-wrap">
            <img src="image/" class="img-fluid" style="width: 680px; height: 400px;">
          </div> -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Hero Section -->

  <div class="co-section before-footer-section">
    <div class="container">
      <div class="row mb-5">
        <form class="col-md-12" method="post" action="update_cart.php">
          <div class="site-blocks-table">
            <table class="table">
              <thead>
                <tr>
                  <th class="product-product">Product</th>
                  <th class="product-customize">Customize</th>
                  <th class="product-price">Price</th>
                  <th class="product-quantity">Quantity</th>
                  <th class="product-total">Total</th>
                  <th class="product-remove">Remove</th>
                </tr>
              </thead>
              <tbody>
              <?php
              // Fetch data from t_cart table with product details joined
              $cart_query = "SELECT t_cart.*, product.product_name, product.product_sprice, product.product_Discount, product.product_images 
                             FROM t_cart 
                             INNER JOIN product ON t_cart.product_id = product.id";
              $cart_statement = $conn->prepare($cart_query);
              $cart_statement->execute();
              $cart_result = $cart_statement->get_result();

              if (mysqli_num_rows($cart_result) > 0) {
                  while ($row = mysqli_fetch_assoc($cart_result)) {
                      // Calculate subtotal for each product
                      $subtotal = $row['product_sprice']; // Assuming no discount applied initially
                      
                      $total += $subtotal; // Add subtotal to total
              ?>
                <tr class="product-row" data-product-id="<?php echo $row['id']; ?>">
                <td class="product-thumbnail">
                  <a class="product-item" href="product.php?id=<?php echo $row['id']; ?>">
                      <img src="image/<?php echo $row['product_images']; ?>" class="img-fluid product-thumbnail" style="width: 140px; height: 140px;">
                      <span class="discount-tag"><?php echo $row['product_Discount']; ?>% off</span>
                  </a>
                  <h3 class="product-title"><?php echo $row['product_name']; ?></h3>
                </td>
                <td class="product-customize">
                    <textarea type="text" id="product_customize_<?php echo $row['id']; ?>" name="product_customize[]" style="border-radius: 30px; padding: 10px;" cols="40" rows="4"></textarea>
                </td>
                <td>₹<?php echo $row['product_sprice']; ?></td>
                <!-- Replace the existing quantity column -->
                <td class="product-quantity">
                    <div class="value-button decrease" onclick="decreaseValue(<?php echo $row['id']; ?>)">-</div>
                    <input type="number" id="number_<?php echo $row['id']; ?>" name="quantity[]" value="1" min="1" onchange="updateSubtotalAndTotal(<?php echo $row['id']; ?>)" />
                    <div class="value-button increase" onclick="increaseValue(<?php echo $row['id']; ?>)">+</div>
                </td>
                <td>
                    <!-- Calculate subtotal for each product -->
					        <span class="subtotal-price" id="subtotal_<?php echo $row['id']; ?>">₹<?php echo $subtotal; ?></span>
                </td>
                <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-black btn-sm">X</a></td>
              </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'><h6>No items in the cart</h6></td></tr>";
            }

            // Display total value after looping through all items
			      echo "<tr><td colspan='4'><h6>Total:</h6></td><td colspan='2' id='total'><h6>₹" . $total . "</h6></td></tr>";
            ?>
            </tbody>
            </table>
          </div>
        </form>
      </div>


      <div class="row">
        <div class="col-md-6">
          <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
              <a href="shop.php" class="btn btn-black btn-sm btn-block">Update Cart</a>
            </div>
            <div class="col-md-6">
              <a href="shop.php" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label class="text-black h4" for="coupon">Coupon</label>
              <p>Enter your coupon code if you have one.</p>
            </div>
            <div class="col-md-8 mb-3 mb-md-0">
              <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
            </div>
            <div class="col-md-4">
              <button class="btn btn-black">Apply Coupon</button>
            </div>
          </div>
        </div>
        <div class="col-md-6 pl-5">
          <div class="row justify-content-end">
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                  <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                </div>
              </div>
              <div class="row mb-3">
			  	<div class="col-md-6">
					<span class="text-black">Subtotal:</span>
				</div>
				<div class="col-md-6 text-right">
					<strong class="text-black" id="subtotal_display">₹<?php echo $total; ?></strong>
				</div><br>
				<div class="col-md-6">
					<span class="text-black">Total:</span>
				</div>
				<div class="col-md-6 text-right">
					<strong class="text-black" id="total_display">₹<?php echo $total; ?></strong>
				</div>
              </div>

              <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-black btn-lg py-3 btn-block" id="proceedToCheckout" onclick="">Proceed To Checkout</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Start Footer Section -->
  <?php include 'footer.php'; ?>
  <!-- End Footer Section -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/tiny-slider.js"></script>
  <script src="js/custom.js"></script>
  <script>

    function increaseValue(productId) {
        var oldValue = parseInt(document.getElementById("number_" + productId).value);
        var newVal = isNaN(oldValue) ? 1 : oldValue + 1;
        document.getElementById("number_" + productId).value = newVal;
        updateSubtotalAndTotal(productId); // Pass correct product ID here
    }

    function decreaseValue(productId) {
        var oldValue = parseInt(document.getElementById("number_" + productId).value);
        var newVal = isNaN(oldValue) ? 1 : (oldValue > 1 ? oldValue - 1 : 1);
        document.getElementById("number_" + productId).value = newVal;
        updateSubtotalAndTotal(productId); // Pass correct product ID here
    }

		function updateSubtotalAndTotal(productId) {
			var quantity = parseInt(document.getElementById("number_" + productId).value);
			var price = parseFloat(document.getElementById("number_" + productId).parentNode.previousElementSibling.textContent.replace('₹', ''));
			var subtotal = quantity * price;
			document.getElementById("subtotal_" + productId).textContent = '₹' + subtotal.toFixed(2);

			var total = 0;
			var subtotals = document.querySelectorAll('.subtotal-price');
			subtotals.forEach(function(element) {
				total += parseFloat(element.textContent.replace('₹', ''));
			});
			document.getElementById('total').innerHTML = "<h6> ₹" + total.toFixed(2) + "</h6>";
			
			// Update subtotal and total in the "Cart Totals" section
			document.getElementById('subtotal_display').innerHTML = '₹' + total.toFixed(2);
			document.getElementById('total_display').innerHTML = '₹' + total.toFixed(2);
		}
	</script>
  	<script>
    	$(document).ready(function(){
    // Function to gather product data from the HTML elements
    function gatherProductData() {
        var productsData = [];
        $(".product-row").each(function() {
            var productId = $(this).data('product-id');
            var quantity = parseInt($(this).find("#number_" + productId).val());
            var customize = $(this).find("#product_customize_" + productId).val();
            // Ensure quantity is greater than zero
            quantity = (quantity > 0) ? quantity : 1;
            var productData = {
                'productId': productId,
                'product_quantity': quantity,
                'product_customize': customize
            };
            productsData.push(productData);
        });
        return productsData;
    }

    // Function to send data to the server and handle the response
    function updateCart() {
        var data = {
            'productsData': JSON.stringify(gatherProductData()) // Encode as JSON string
        };

        $.ajax({
            type: "POST",
            url: "update_cart.php",
            data: data,
            success: function(response) {
                console.log(response);
                // Redirect to checkout page or show a success message
                window.location.href = "checkout.php";
            },
            error: function(xhr, status, error) {
              console.error("AJAX Error: " + error);
            }
        });
    }

    // Click event handler for the checkout button
    $("button#proceedToCheckout").click(function() {
        // Check if the cart is empty before proceeding
        if ($(".product-row").length === 0) {
            alert("Your cart is empty. Please add items before proceeding to checkout.");
        } else {
            updateCart(); // Proceed to update the cart
        }
    });
});

	</script>

  
</body>
</html>
