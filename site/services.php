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
		<title>Services</title>
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
								<h1>Services</h1>
								<p class="mb-4"></p>
								<p><a href="shop.php" class="btn btn-secondary me-2">Shop Now</a><a href="journey.php" class="btn btn-white-outline">Explore Our journey</a></p>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="image\art2.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				
				
			<div class="row my-5">
			<div class="col-12 col-md-6 col-lg-6 mb-4">
				<div class="feature">
					<div class="icon">
						<img src="image/icons/truck.svg" alt="Image" class="img-fluid">
					</div>
					<h3>Fast &amp; Free Shipping...?</h3>
					<p>We Value Your Satisfaction: Providing free shipping is our way of saying thank you for choosing Izna Store. No hidden fees or extra costs. What you see is what you pay.</p>
				</div>
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-4">
				<div class="feature">
					<div class="icon">
						<img src="image/icons/bag.svg" alt="Image" class="img-fluid">
					</div>
					<h3>Easy to Shop...?</h3>
					<p>At Izna Store, we've designed your shopping experience to be as easy as 1-2-3! Enjoy a seamless journey from browsing to checkout, and let the creativity flow effortlessly.</p>
				</div>
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-4">
				<div class="feature">
					<div class="icon">
						<img src="image/icons/support.svg" alt="Image" class="img-fluid">
					</div>
					<h3>24/7 Support...?</h3>
					<p>At Izna Store, we're here for you 24/7, providing dedicated support to enhance your shopping experience.</p>
				</div>
			</div>

			<div class="col-12 col-md-6 col-lg-6 mb-4">
				<div class="feature">
					<div class="icon">
						<img src="image/icons/return.svg" alt="Image" class="img-fluid">
					</div>
					<h3>Product is customized...?</h3>
					<p>At Izna Store, every product is uniquely customized to match your personal style and preferences.</p>
				</div>
			</div>
		</div>

		</div>
		</div>
		<!-- End Why Choose Us Section -->
		
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

		<!-- Start Header/Navigation -->
		<?php include 'timeline.html'; ?>
		<!-- End Header/Navigation -->

		<!-- Start Testimonial Slider -->
		<div class="testimonial-section before-footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Customer Feedback</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">

                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">

                        <!-- Customer Feedback Item 1 -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Received my order yesterday and I'm absolutely thrilled with the resin frame! The craftsmanship is impeccable and it looks even better in person. Thank you so much!&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
												<img src="image/icons/person_f2.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Ikra Shaik</h3>
                                            <span class="position d-block mb-3">Happy Customer</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END Customer Feedback Item 1 -->

                        <!-- Customer Feedback Item 2 -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Just received my customized resin frame and I'm blown away by the quality! It's exactly what I wanted and arrived in perfect condition. Thank you for your excellent service!&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
												<img src="image/icons/person_f4.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Priya Sharma</h3>
                                            <span class="position d-block mb-3">Satisfied Customer</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END Customer Feedback Item 2 -->

                        <!-- Customer Feedback Item 3 -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Absolutely loved my resin frame! The detailing is exquisite, and it adds a unique touch to my decor. Highly recommend Izna Stores for their quality craftsmanship.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
												<img src="image/icons/person_m4.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">GaneshWar Reddy</h3>
                                            <span class="position d-block mb-3">Delighted Customer</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END Customer Feedback Item 3 -->

                        <!-- Customer Feedback Item 4 -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Received my order well within the expected delivery time. The resin frame is stunning, and the customization options allowed me to create a truly personalized piece. Thank you, Izna Stores!&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
												<img src="image/icons/person_f1.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Sana Syed</h3>
                                            <span class="position d-block mb-3">Satisfied Customer</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END Customer Feedback Item 4 -->

                        <!-- Customer Feedback Item 5 -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Thank you, Izna Stores, for the beautiful resin frame! It exceeded my expectations, and the attention to detail is remarkable. Will definitely be shopping here again.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
												<img src="image/icons/person_f3.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Ananya Singh</h3>
                                            <span class="position d-block mb-3">Happy Customer</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END Customer Feedback Item 5 -->

                        <!-- Customer Feedback Item 6 -->
                        <div class="item">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 mx-auto">

                                    <div class="testimonial-block text-center">
                                        <blockquote class="mb-5">
                                            <p>&ldquo;Received my order today, and I couldn't be happier with my resin frame! It's exactly what I envisioned, and the quality is top-notch. Thank you for the excellent service.&rdquo;</p>
                                        </blockquote>

                                        <div class="author-info">
                                            <div class="author-pic">
												<img src="image/icons/person_m2.png" alt="Maria Jones" class="img-fluid">
                                            </div>
                                            <h3 class="font-weight-bold">Rahul Kumar</h3>
                                            <span class="position d-block mb-3">Satisfied Customer</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END Customer Feedback Item 6 -->

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- End Testimonial Slider -->

		

		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
