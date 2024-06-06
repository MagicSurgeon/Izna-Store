<?php
include 'data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Mad_Cat">
		<link rel="shortcut icon" href="image/logo.png">

		<meta name="description" content="" />
		<meta name="keywords" content="bootstrap, bootstrap4" />
		<!-- Bootstrap Font Icon CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
		<link rel="stylesheet" href="css/blog.css">
		<title>Izna's Blog's</title>
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
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
								<h1>Izna's Blog's</h1>
								<p class="mb-4">"At Izna Store, we don't just create resin art; we craft moments of beauty that linger in the heart long after the purchase."</p>
								<p><a href="shop.php" class="btn btn-secondary me-2">Shop Now</a><!--<a href="#" class="btn btn-white-outline">Explore</a></p>-->
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="image/cup holder2.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->


		<!-- Start Blog Section -->
		<div class="cont">
        <div class="blog-section">
            <div class="container">
		<?php
				$query = "SELECT * FROM blog WHERE is_active = 1";
				$data = mysqli_query($conn, $query);
				$result = mysqli_num_rows($data);

				if ($result) {
					echo '<div class="row">';
					$count = 0; // Initialize count variable
					while ($row = mysqli_fetch_array($data)) {
						if ($count % 3 == 0 && $count != 0) {
							echo '</div><div class="row">'; // Close current row and start a new one after every three posts
						}
					?>
					<div class="col-md-4 mb-5">
						<div class="col-md-4">
							<div class="card">
								<img src="image/<?php echo $row['blog_image']; ?>" alt="image test">
								<div class="info">
									<h1><?php echo $row['blog_name']; ?></h1>
									<h6><b class="bi bi-pen"> <?php echo $row['blog_author']; ?></b> &nbsp;&nbsp;<b class="bi bi-calendar3" style="float: right; margin-left: 5px;"> <?php echo $row['blog_date']; ?></b><h6>
									<p style="text-align: justify;"><?php echo substr($row['blog_description'], 2, 60) . '...'; ?></p>
									<a href="blog_details.php?id=<?php echo $row['id']; ?>" class="btn">Read More</a>
								</div>
							</div>
						</div>
					</div>
				<?php
							$count++; // Increment count variable
						}
						echo '</div>'; // Close the last row
					} else {
						echo "<p>No active blogs found.</p>";
					}
				?>
			</div>
		</div>
	</div>
		<!-- Start Blog Section -->
	
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
													<img src="image/icons/person-1.png" alt="Maria Jones" class="img-fluid">
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
													<img src="image/icons/person-1.png" alt="Maria Jones" class="img-fluid">
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
													<img src="image/icons/person-1.png" alt="Maria Jones" class="img-fluid">
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
													<img src="image/icons/person-1.png" alt="Maria Jones" class="img-fluid">
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
													<img src="image/icons/person-1.png" alt="Maria Jones" class="img-fluid">
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
													<img src="image/icons/person-1.png" alt="Maria Jones" class="img-fluid">
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