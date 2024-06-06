<?php
include 'data.php';
if (session_status() == PHP_SESSION_NONE) {
	session_start(); 
}
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
  <link rel="stylesheet" href="css\tracking.css">
  <title>Thank for shoping</title>
  <style>
	.container1 {
		margin-top:-260px;
	}
	.container2 {
		margin-top:-200px;
		margin-bottom: auto;
		padding: 80px;
	}
	.card1 {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }
    .card1 {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: 1rem;
    }
    .text-reset {
        --bs-text-opacity: 1;
        color: inherit!important;
    }
    a {
        color: #5465ff;
        text-decoration: none;
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
								<h1>Orders</h1>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

	<div class="kareem_co-section">
		<div class="container1">
				<div class="row">
					<!-- Start Tracking Section -->
						<section class="vh-100">
							<div class="container py-5 h-100">
								<div class="row d-flex justify-content-center align-items-center h-100">
								<div class="col-12">
									<div class="card card-stepper text-black" style="border-radius: 16px;">

									<div class="card-body p-5">

										<div class="d-flex justify-content-between align-items-center mb-5">
										<div>
											<h5 class="mb-0">INVOICE <span class="text-primary font-weight-bold">#</span></h5>
										</div>
										<div class="text-end">
											<p class="mb-0">Expected Arrival <span><?php echo $row['created_at']; ?></span></p>
											<p class="mb-0">Tracking Number <span class="font-weight-bold"><?php echo $row['id']; ?></span></p>
										</div>
										</div>

										<ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 mb-5 px-0 pt-0 pb-2">
										<li class="step0 active text-center" id="step1"></li>
										<li class="step0 active text-center" id="step2"></li>
										<li class="step0 active text-center" id="step3"></li>
										<li class="step0 text-muted text-end" id="step4"></li>
										</ul>

										<div class="d-flex justify-content-between">
										<div class="d-lg-flex align-items-center">
											<i class="fas fa-clipboard-list fa-3x me-lg-4 mb-3 mb-lg-0"></i>
											<div>
											<p class="fw-bold mb-1">Order</p>
											<p class="fw-bold mb-0">Processed</p>
											</div>
										</div>
										<div class="d-lg-flex align-items-center">
											<i class="fa-solid fa-truck-ramp-box fa-3x me-lg-4 mb-3 mb-lg-0"></i>
											<div>
											<p class="fw-bold mb-1">Order</p>
											<p class="fw-bold mb-0">Shipped</p>
											</div>
										</div>
										<div class="d-lg-flex align-items-center">
											<i class="fas fa-shipping-fast fa-3x me-lg-4 mb-3 mb-lg-0"></i>
											<div>
											<p class="fw-bold mb-1">Order</p>
											<p class="fw-bold mb-0">on Route</p>
											</div>
										</div>
										<div class="d-lg-flex align-items-center">
											<i class="fa-solid fa-parachute-box fa-3x me-lg-4 mb-3 mb-lg-0"></i>
											<div>
											<p class="fw-bold mb-1">Out</p>
											<p class="fw-bold mb-0">For Delivary</p>
											</div>
										</div>
										<div class="d-lg-flex align-items-center">
											<i class="fas fa-home fa-3x me-lg-4 mb-3 mb-lg-0"></i>
											<div>
											<p class="fw-bold mb-1">Order</p>
											<p class="fw-bold mb-0">Arrived</p>
											</div>
										</div>
										</div>

									</div>

									</div>
								</div>
							</div>
						</div>
					</section>  
				<!-- End Tracking Section -->

				<!-- Start Details Section -->
				<div class="container-fluid">

					<div class="container2">
					<!-- Title -->
					<div class="d-flex justify-content-between align-items-center py-3">
						<h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order Id #<?php echo $row['id']; ?></h2>
					</div>

					<!-- Main content -->
					<div class="row">
						<div class="col-lg-8">
						<!-- Details -->
						<div class="card1 mb-4">
							<div class="card-body">
							<div class="mb-3 d-flex justify-content-between">
								<div>
								<span class="me-3">Order Id #<?php echo $row['id']; ?></span>
								<span class="me-3">#16123222</span>
								<span class="me-3">Visa -1234</span>
								<span class="badge rounded-pill bg-info">SHIPPING</span>
								</div>
								<div class="d-flex">
								<button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></button>
								</div>
							</div>
							<table class="table table-borderless">
								<tbody>
								<tr>
									<td>
									<div class="d-flex mb-2">
										<div class="flex-shrink-0">
										<img src="<?php echo $row['product_images'] ?? ''; ?>" alt="" width="35" class="img-fluid">
										</div>
										<div class="flex-lg-grow-1 ms-3">
										<h6 class="small mb-0"><a href="#" class="text-reset"><?php echo $row['product_name'] ?? ''; ?>.</a></h6>
										<span class="small"><?php echo $row['product_customize'] ?? ''; ?></span>
										</div>
									</div>
									</td>
									<td><?php echo $row['product_quantity'] ?? ''; ?></td>
									<td class="text-end">₹<?php echo $row['product_sprice'] ?? ''; ?></td>
								</tr>
								<tr>
									<!-- <td>
									<div class="d-flex mb-2">
										<div class="flex-shrink-0">
										<img src="https://www.bootdey.com/image/280x280/FF69B4/000000" alt="" width="35" class="img-fluid">
										</div>
										<div class="flex-lg-grow-1 ms-3">
										<h6 class="small mb-0"><a href="#" class="text-reset">Smartwatch IP68 Waterproof GPS and Bluetooth Support</a></h6>
										<span class="small">Color: White</span>
										</div>
									</div>
									</td>
									<td>1</td>
									<td class="text-end">$79.99</td> -->
								</tr>
								</tbody>
								<tfoot>
								<tr>
									<td colspan="2">Subtotal</td>
									<td class="text-end">₹<?php echo $row['subtotal'] ?? ''; ?></td>
								</tr>
								<tr>
									<td colspan="2">Shipping</td>
									<td class="text-end">$20.00</td>
								</tr>
								<tr>
									<td colspan="2">Discount (Code: NEWYEAR)</td>
									<td class="text-danger text-end">-$10.00</td>
								</tr>
								<tr class="fw-bold">
									<td colspan="2">TOTAL</td>
									<td class="text-end">₹<?php echo $row['total'] ?? ''; ?></td>
								</tr>
								</tfoot>
							</table>
							</div>
						</div>
						<!-- Payment -->
						<div class="card1 mb-4">
							<div class="card-body">
							<div class="row">
								<div class="col-lg-6">
								<h3 class="h6">Payment Method</h3>
								<p>Phonepe <br>
								Total: ₹ 0.00 <span class="badge bg-success rounded-pill">PAID</span></p>
								</div>
								<div class="col-lg-6">
								<h3 class="h6">Billing address</h3>
								<address>
									<strong><?php echo $row['c_nname'] ?? ''; ?></strong><br>
									<?php echo $row['c_address'] ?? ''; ?><br>
									<?php echo $row['l_mark'] ?? ''; ?>, <?php echo $row['c_state'] ?? ''; ?> <?php echo $row['c_postal_zip'] ?? ''; ?><br>
									<abbr title="Phone">Number </abbr> <?php echo $row['c_phone'] ?? ''; ?>
								</address>
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="col-lg-4">
						<!-- Customer Notes -->
						<div class="card1 mb-4">
							<div class="card-body">
							<h3 class="h6">Customer Notes</h3>
							<p><?php echo $row['c_order_notes'] ?? ''; ?>.</p>
							</div>
						</div>
						<div class="card1 mb-4">
							<!-- Shipping information -->
							<div class="card-body">
							<h3 class="h6">Shipping Information</h3>
							<strong>Courier Service</strong>
							<span><a href="#" class="text-decoration-underline" target="_blank">FF1234567890</a> <i class="bi bi-box-arrow-up-right"></i> </span>
							<hr>
							<h3 class="h6">Address</h3>
							<address>
								<strong><?php echo $row['c_nname']; ?></strong><br>
								<?php echo $row['c_address'] ?? ''; ?><br>
								<?php echo $row['l_mark'] ?? ''; ?>, <?php echo $row['c_state'] ?? ''; ?> <?php echo $row['c_postal_zip'] ?? ''; ?><br>
								<abbr title="Phone">Number </abbr> <?php echo $row['c_phone'] ?? ''; ?>
							</address>
							</div>
						</div>
						</div>
					</div>
					</div>
					</div>
				<!-- End Details Section -->

			</div>
		</div>
	</div>

		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	

		 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</body>
</html>
