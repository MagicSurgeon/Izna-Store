<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="css/tiny-slider.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <title>Profile</title>

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
              <?php 
                    mysqli_data_seek($result, 0); 
                    while($row = $result->fetch_assoc()): 
                    ?>
                    <h1><?php echo $row['name']; ?>'s Profile</h1>
                    <?php endwhile; ?>
							</div>
						</div>
						<div class="col-lg-7">
							
						</div>
					</div>
				</div>
			</div>
		<!-- End Hero Section -->

		

		 <!-- Main Content Section -->
     <div class="kareem_co-section">          
        <div class="row">    
          <section class="section">
            <div class="section__container">
              
              <!-- Start card Section -->
              <?php include 'profile_card.php'; ?>
          		<!-- End card Section -->	

              <!-- <h1>Address</h1><br> -->
              <!-- Start address Section -->
              <!-- <?php include 'address_card.php'; ?> -->
              <!-- End address Section -->

            </div>
          </section>
        </div>
      </div>
    
		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	</body>

</html>
