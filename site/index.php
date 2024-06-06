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
		<title>Home</title>
	</head>

	<body>

		<!-- Start Header/Navigation -->
		<?php include 'header.php'; ?>
		<!-- End Header/Navigation -->

		<!-- Start Banner Section -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<div class="col-lg-5">
							<div class="intro-excerpt">
								<h1>Modern Art <span clsas="d-block">Personalize Studio</span></h1>
								<p class="mb-4">Abstract Expressionism, Materials and Mediums, Personalization, Innovation in Techniques.</p>
								<p><a href="" class="btn btn-secondary me-2">Shop Now</a><!--<a href="#" class="btn btn-white-outline">Explore</a>--></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="image/clock.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Banner Section -->

		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container">
				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">Crafted with excellent material.</h2>
						<p class="mb-4">
							Resin products encompass a diverse range of items created using epoxy resin as a primary material. These products have gained popularity for their unique aesthetics, durability, and versatility </p>
						<p><a href="shop.html" class="btn">Explore</a></p>
					</div> 
					<!-- End Column 1 -->

					<!-- Start Column 2 -->
					<div class="col-12 col-md-12 col-lg-9 mb-5 mb-md-0">
						<div class="row">
							<?php
								$query = "SELECT * FROM product WHERE is_active = 1 ORDER BY id DESC LIMIT 3";
								$data = mysqli_query($conn, $query);
								$result = mysqli_num_rows($data);

								if ($result) {
									while ($row = mysqli_fetch_array($data)) {
							?>
										<div class="col-md-4 mb-4">
											<a class="product-item" href="product.php?id=<?php echo $row['id']; ?>">
												<img src="image/<?php echo $row['product_images']; ?>" class="img-fluid product-thumbnail" style="width: 100%; height: 200px; object-fit: cover;">
												<h3 class="product-title"><?php echo $row['product_name']; ?></h3>
												<strong class="product-price"><s><span style="color:red; font-size: 15px;">₹<?php echo $row['product_mrp']; ?></span></s>&nbsp;&nbsp; <b>₹<?php echo $row['product_sprice']; ?></b></strong>
												<span class="icon-cross">
													<img src="image/icons/cross.svg" class="img-fluid">
												</span>
											</a>
										</div>
							<?php
									}
								}
							?>
						</div>
					</div>

					<!-- End Column 2 -->
				</div>
			</div>
		</div>
		<!-- End Product Section -->

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h2 class="section-title">Why Choose Us</h2>
						<p>Choosing us means choosing a seamless shopping experience, high-quality products, and a supportive community. Join us on this artistic adventure, and let your creativity flourish with our exceptional resin products.</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="image/icons/truck.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Fast &amp; Free Shipping...?</h3>
									<p>We Value Your Satisfaction: Providing free shipping is our way of saying thank you for choosing Izna Store. No hidden fees or extra costs. What you see is what you pay.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="image/icons/bag.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Easy to Shop...?</h3>
									<p>At Izna Store, we've designed your shopping experience to be as easy as 1-2-3! Enjoy a seamless journey from browsing to checkout, and let the creativity flow effortlessly.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="image/icons/support.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>24/7 Support...?</h3>
									<p>At Izna Store, we're here for you 24/7, providing dedicated support to enhance your shopping experience.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="image/icons/return.svg" alt="Image" class="imf-fluid">
									</div>
									<h3>Product is customized...?</h3>
									<p>At Izna Store, every product is uniquely customized to match your personal style and preferences.</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="image/art Resin.jpeg" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- End Why Choose Us Section -->

		<!-- Start We Help Section -->
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
							<div class="grid grid-1"><img src="image/img8.png" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="image/img4.jpg" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="image/Keychain, Personalised.jpeg" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title mb-4">
							"Gift with Heart..!"</h2>
						<p>At Izna Store, our expert team is dedicated to assisting you in selecting thoughtful and personalized gifts. Explore our curated collection of customized resin items to make every occasion special, ensuring your loved ones receive a truly unique and cherished present.</p>

						<ul class="list-unstyled custom-list my-4">
							<li>Unwrap Emotions: Personalize Your Gifts with Izna Store's Custom Resin Art.</li>
							<li>Elevate Gifting: Crafted Exclusively for Your Loved Ones at Izna Store.</li>
							<li>Expressive Impressions: Unique Resin Creations Tailored for Every Occasion.</li>
							<li>Thoughtful Gifts, Artfully Designed: Find Your Perfect Customized Resin Surprise.</li>
						</ul>
						<p><a herf="shop.php" class="btn">Explore</a></p>
					</div>
				</div>
			</div>
		</div>
		<!-- End We Help Section -->

		<!-- Start Popular Product -->
		<?php include 'blog_card.php'; ?>
		<!-- End Popular Product  -->	

		<!-- start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
