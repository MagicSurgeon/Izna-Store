<?php
include 'data.php';
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

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>Shop</title>

		<style>
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

		<!-- Start Header/Navigation -->
		<?php include 'header.php'; ?>
		<!-- End Header/Navigation -->

		<!-- Start Hero Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Shop</h1>
								<p>Discover the artistry in every detail. Shop unique resin creations that tell a story of passion and individuality.</p>
								<p><a href="#Explore" class="btn btn-secondary me-2">Explore</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="image/img4.jpg" class="img-fluid" style="width: 680px; height: auto;">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<div class="mad3_co-section product-section before-footer-section">
		    <div class="container" id="Explore">
			<div class="row">
			<?php
				$query = "SELECT * FROM product WHERE is_active = 1";
				$data = mysqli_query($conn, $query);
				$result = mysqli_num_rows($data);

				if ($result) {
					while ($row = mysqli_fetch_array($data)) {
						?>
						<div class="col-12 col-md-4 mb-5">
							<a class="product-item" href="product.php?id=<?php echo $row['id']; ?>">
								<span class="discount-tag"><?php echo $row['product_Discount']; ?>% off</span>
								<img src="image/<?php echo $row['product_images']; ?>" class="img-fluid product-thumbnail" style="width: 240px; height: 240px;">
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
		    </div>
		</div>


		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	
		
		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
