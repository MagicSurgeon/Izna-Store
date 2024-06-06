<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start(); 
  }

// Include database connection
include 'data.php';
$subtotals = array();

$sql = "SELECT t_cart.product_id, t_cart.quantity, product.product_name, product.product_sprice, (t_cart.quantity * product.product_sprice) AS subtotal
        FROM t_cart
        INNER JOIN product ON t_cart.product_id = product.id";
$result = mysqli_query($conn, $sql);

// Initialize variables to store product details
$productDetails = array();
$total = 0; // Initialize total to calculate the total for the entire order

while ($row = mysqli_fetch_assoc($result)) {
    // Add the subtotal to the total
    $total += $row['subtotal'];

    // Store product details in the productDetails array
    $productDetails[] = $row;

    // Add the subtotal to the subtotals array
	$subtotals[] = $row['quantity'] * $row['product_sprice'];
}

// Set the cart subtotal to be equal to the total
$cartsubTotal = $total;

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

		 <!-- jQuery library -->
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>One Step to Grap Your Order </title>

<!-- jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <style>
    .warning {
      color: red;
      font-size: 12px;
    }
  </style>
  
  <script>
    $(document).ready(function(){
      // Function to validate form fields
      function validateForm() {
        var isValid = true;

        // Remove any existing warning messages
        $('.warning').remove();

        // Validate Nick Name field
        if (!$('#c_nname').val()) {
          $('#c_nname').after('<div class="warning">Enter your Nick Name</div>');
          isValid = false;
        }

        // Validate Country field
        if ($('#c_country').val() == '1') {
          $('#c_country').after('<div class="warning">Select a Country</div>');
          isValid = false;
        }

        // Validate Address field
        if (!$('#c_address').val()) {
          $('#c_address').after('<div class="warning">Enter your Address</div>');
          isValid = false;
        }

        // Validate State field
        if (!$('#c_state').val()) {
          $('#c_state').after('<div class="warning">Enter your State</div>');
          isValid = false;
        }

        // Validate Pincode field
        var pincode = $('#c_postal_zip').val();
        if (!pincode || pincode.length !== 6 || isNaN(pincode)) {
          $('#c_postal_zip').after('<div class="warning">Pincode must have 6 digits</div>');
          isValid = false;
        }

        // Validate Email field and display warning if @gmail.com is not used
        var email = $('#c_email_address').val();
        if (!email || email.indexOf('@') === -1 || email.indexOf('@gmail.com') === -1) {
          $('#c_email_address').after('<div class="warning">Enter a valid Gmail address</div>');
          isValid = false;
        }

        // Validate Phone field
        var phone = $('#c_phone').val();
        if (!phone || phone.length !== 10 || isNaN(phone)) {
          $('#c_phone').after('<div class="warning">Phone number must have 10 digits</div>');
          isValid = false;
        }

        // Additional validation logic can be added here

        return isValid;
      }

      // Handle form submission when the "Place Order" button is clicked
      $('#place-order-btn').click(function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Validate the form
        if (validateForm()) {
          // If the form is valid, submit the form
          $('form').submit();
          // window.location = 'thankyou.php'; // Uncomment this line if you want to redirect to thankyou.php
        }
      });
    });
  </script>

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
								<h1>Checkout</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		<div class="kareem_co-section">
		    <div class="container">
		      <div class="row mb-5">
		        <div class="col-md-12">
		          <div class="border p-4 rounded" role="alert">
		            Returning customer? <a href="shop.php">Click Here</a> To Continue Shopping.
		          </div>
		        </div>
		      </div>
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Billing Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
					
				  <form method="post" action="process_form.php" id="checkout-form">
		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_nname" class="text-black">Nick Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="c_nname" name="c_nname" required>
					  </div>
		              <!-- <div class="col-md-6">
		                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_lname" name="c_lname" required>
		              </div> -->
		            </div>
					<div class="form-group">
		              <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
						<select id="c_country" class="form-control" name="c_country">
							<option value="Select a country">Select a country</option>    
							<option value="bangladesh">Bangladesh</option>    
							<option value="India">India</option>    
							<option value="Algeria">Algeria</option>    
							<option value="Afghanistan">Afghanistan</option>    
							<option value="Pakistan">Pakistan</option>    
							<option value="Ghana">Ghana</option>    
							<option value="Albania">Albania</option>    
							<option value="Bahrain">Bahrain</option>    
							<option value="Colombia">Colombia</option>    
							<option value="Dominican Republic">Dominican Republic</option>    
						</select>
					</div>

		            <!-- <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_companyname" class="text-black">Mobile Number </label>
		                <input type="text" class="form-control" id="c_companyname" name="c_companyname">
		              </div>
		            </div> -->

		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" required>
					  </div>
		            </div>

		            <div class="form-group mt-3">
						<input type="text" class="form-control" id="l_mark" name="l_mark" placeholder="Lank Mark (optional)">
					</div>

		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_state" class="text-black">State / Country <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_state" name="c_state" required>
		              </div>
		              <div class="col-md-6">
		                <label for="c_postal_zip" class="text-black">Pincode / Zip <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip" required>
		              </div>
		            </div>

		            <div class="form-group row mb-5">
		              <div class="col-md-6">
		                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_email_address" name="c_email_address" required>
		              </div>
		              <div class="col-md-6">
		                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" required>
		              </div>
		            </div>

		            <!-- <div class="form-group">
		              <label for="c_create_account" class="text-black" data-bs-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Create an account?</label>
		              <div class="collapse" id="create_an_account">
		                <div class="py-2 mb-4">
		                  <p class="mb-3">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
		                  <div class="form-group">
		                    <label for="c_account_password" class="text-black">Account Password</label>
		                    <input type="email" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
		                  </div>
		                </div>
		              </div>
		            </div>


		            <div class="form-group">
		              <label for="c_ship_different_address" class="text-black" data-bs-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="checkbox" value="1" id="c_ship_different_address"> Ship To A Different Address?</label>
		              <div class="collapse" id="ship_different_address">
		                <div class="py-2">

		                  <div class="form-group">
		                    <label for="c_diff_country" class="text-black">Country <span class="text-danger">*</span></label>
		                    <select id="c_diff_country" class="form-control">
		                      <option value="1">Select a country</option>    
		                      <option value="2">bangladesh</option>    
		                      <option value="3">Algeria</option>    
		                      <option value="4">Afghanistan</option>    
		                      <option value="5">Ghana</option>    
		                      <option value="6">Albania</option>    
		                      <option value="7">Bahrain</option>    
		                      <option value="8">Colombia</option>    
		                      <option value="9">Dominican Republic</option>    
		                    </select>
		                  </div>


		                  <div class="form-group row">
		                    <div class="col-md-6">
		                      <label for="c_diff_fname" class="text-black">First Name <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_fname" name="c_diff_fname">
		                    </div>
		                    <div class="col-md-6">
		                      <label for="c_diff_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_lname" name="c_diff_lname">
		                    </div>
		                  </div>

		                  <div class="form-group row">
		                    <div class="col-md-12">
		                      <label for="c_diff_companyname" class="text-black">Company Name </label>
		                      <input type="text" class="form-control" id="c_diff_companyname" name="c_diff_companyname">
		                    </div>
		                  </div>

		                  <div class="form-group row  mb-3">
		                    <div class="col-md-12">
		                      <label for="c_diff_address" class="text-black">Address <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_address" name="c_diff_address" placeholder="Street address">
		                    </div>
		                  </div>

		                  <div class="form-group">
		                    <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
		                  </div>

		                  <div class="form-group row">
		                    <div class="col-md-6">
		                      <label for="c_diff_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_state_country" name="c_diff_state_country">
		                    </div>
		                    <div class="col-md-6">
		                      <label for="c_diff_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_postal_zip" name="c_diff_postal_zip">
		                    </div>
		                  </div>

		                  <div class="form-group row mb-5">
		                    <div class="col-md-6">
		                      <label for="c_diff_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_email_address" name="c_diff_email_address">
		                    </div>
		                    <div class="col-md-6">
		                      <label for="c_diff_phone" class="text-black">Phone <span class="text-danger">*</span></label>
		                      <input type="text" class="form-control" id="c_diff_phone" name="c_diff_phone" placeholder="Phone Number">
		                    </div>
		                  </div>

		                </div>

		              </div>
		            </div> -->

		            <div class="form-group">
		              <label for="c_order_notes" class="text-black">Order Notes</label>
					  <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
		            </div>

		          </div>
		        </div>
		        <div class="col-md-6">

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Coupon Code</h2>
		              <div class="p-3 p-lg-5 border bg-white">

		                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
		                <div class="input-group w-75 couponcode-wrap">
		                  <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
		                  <div class="input-group-append">
		                    <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
		                  </div>
		                </div>

		              </div>
		            </div>
		          </div>

		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Your Order</h2>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Product</th>
		                    <th>Total</th>
		                  </thead>
		                  <tbody>
							<?php foreach ($productDetails as $row): ?>
								<tr>
								<td><?php echo $row['product_name']; ?> <strong class="mx-2">x</strong> <?php echo $row['quantity']; ?></td>
								<td>₹<?php echo $row['subtotal']; ?></td>
								<input type="hidden" name="subtotals" value="<?php echo implode(',', $subtotals); ?>">
								</tr>
							<?php endforeach; ?>
								<tr>
								<td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
								<td class="text-black">₹<?php echo $cartsubTotal; ?></td>
								</tr>
								<tr>
								<td class="text-black font-weight-bold"><strong>Order Total</strong></td>
								<td class="text-black font-weight-bold"><strong>₹<?php echo $total; ?></strong></td>
								</tr>
		                  </tbody>
		                </table>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">UPI</a></h3>

		                  <div class="collapse" id="collapsebank">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-3">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Card Payment</a></h3>

		                  <div class="collapse" id="collapsecheque">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="border p-3 mb-5">
		                  <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Cash On Delivary</a></h3>

		                  <div class="collapse" id="collapsepaypal">
		                    <div class="py-2">
		                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group">
							<button type="submit" id="place-order-btn" class="btn btn-black btn-lg py-3 btn-block">Place Order</button>
		                </div>

		              </div>
		            </div>
		          </div>

		        </div>
		      </div>
		      </form>
		    </div>
		  </div>

		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	

		<!-- JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
			$('#place-order-btn').click(function(event) {
				event.preventDefault();
				
				// AJAX request to insert data into billing_address
				$.ajax({
					url: 'insert_billing_address.php',
					type: 'POST',
					data: $('#checkout-form').serialize(),
					success: function(response) {
						if(response === 'success') {
							// If insertion into billing_address is successful, proceed with inserting into the cart table
							$.ajax({
								url: 'insert_cart_data.php',
								type: 'POST',
								data: $('#checkout-form').serialize(),
								success: function(response) {
									if(response === 'success') {
										// If insertion into cart table is successful, redirect to thankyou.php
										window.location = 'thankyou.php';
									} else {
										// Handle error
										alert('Failed to insert data into cart.');
									}
								},
								error: function(xhr, status, error) {
									console.error(xhr.responseText);
								}
							});
						} else {
							// Handle error
							alert('Failed to insert data into billing address.');
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					}
				});
			});
		});
		</script>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
