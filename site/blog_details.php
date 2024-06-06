<?php
// Include the file that establishes the database connection
include 'data.php';

// Check if the connection was successful
if ($conn) {
    // Retrieve the blog post ID from the URL parameter
    if(isset($_GET['id'])) {
        $blog_id = $_GET['id'];

        // Fetch the details of the blog post with the given ID
        $query = "SELECT * FROM blog WHERE id = $blog_id AND is_active = 1";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Check if the blog post exists
            if (mysqli_num_rows($result) > 0) {
                // Blog post found, display its details
                $blog = mysqli_fetch_assoc($result);
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
		<title><?php echo $blog['blog_name']; ?> Detail</title>
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
							<h1><?php echo $blog['blog_name']; ?></h1>
							<h4 style="color: white;"><?php echo $blog['blog_category']; ?></h4>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="hero-img-wrap">
							<img src="image/<?php echo $blog['blog_image']; ?>" class="img-fluid" style="display: inline-block;">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Hero Section -->

		<!-- Start Blog Section -->
		<div class="row my-5 justify-content-center">
			<div class="col-12 col-md-6 col-lg-6 mb-4 text-center" style="width: 90%;">
				<div class="feature" style="background-color: transperant; padding: 30px; border-radius: 25px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
					<div class="blog-content" style="width: 100%; text-align: left;">
						<?php echo htmlspecialchars_decode($blog['blog_description']); ?>
					</div>
				</div>
			</div>
		</div>

		<!-- End Blog Section -->


		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
<?php
            } else {
                // Blog post not found
                echo "Blog not found!";
            }
        } else {
            // Error executing the query
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // No blog ID provided in the URL
        echo "Invalid request!";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Connection not established
    echo "Error: Unable to connect to the database.";
}
?>
