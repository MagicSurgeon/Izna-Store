<?php
include 'data.php';

if(isset($_POST['button_temp'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $m_num = $_POST['m_num'];
  $message = $_POST['message'];

  // Database interaction
  $sql = "INSERT INTO contact_us (fname, lname, email, m_num, message, is_active) VALUES (?, ?, ?, ?, ?,1)";
  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt) {
      mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $m_num, $message); // Fixed parameter count here
      if (mysqli_stmt_execute($stmt)) {
          // Redirect to the same page after successful upload
          header('Location: ' . $_SERVER["REQUEST_URI"]);
          exit();
      } else {
          echo "Error executing statement: " . mysqli_stmt_error($stmt);
      }

      mysqli_stmt_close($stmt);
  } else {
      echo "Error preparing statement: " . mysqli_error($conn);
  }
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

		<!-- Bootstrap CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
		<title>Contact Us</title>
    <style>
      .google-map {
          padding-bottom: 50%;
          position: relative;
      }

      .google-map iframe {
          height: 100%;
          width: 100%;
          left: 0;
          top: 0;
          position: absolute;
      }
      h2 {
          text-align: center;
          font-family: Arial, sans-serif;
          font-size: 48px;
          color: #3b5d50;
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
          transition: color 0.3s ease, transform 0.3s ease;
      }

      h2:hover {
          color: #f9bf29; 
          text-shadow: 1px 1px 3px black;
          transform: scale(1.1);
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
								<h1>Contact</h1>
								<p class="mb-4">At Izna Store, every question finds an answer, and every conversation is a brushstroke in our canvas of customer satisfaction. Reach out; we're here for you.</p>
								<p><a href="" class="btn btn-secondary me-2">Shop Now</a><!--<a href="#" class="btn btn-white-outline">Explore</a></p>-->
							</div>
						</div>
						<div class="col-lg-7">
							<div class="hero-img-wrap">
								<img src="image/frame.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div><br><br>
		<!-- End Hero Section -->

		<!-- Start location Section -->
      <div class="container">
        <div class="block">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 pb-4">
                    <div class="row mb-5">
                        <div class="col-lg-4">
                            <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                                <div class="service-icon color-1 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                    </svg>
                                </div> <!-- /.icon -->
                                <div class="service-contents">
                                    <p>Childrens Park Rd, Pinakini Avenue, Ramji Nagar, Nellore, Andhra Pradesh 524003</p>
                                </div> <!-- /.service-contents-->
                            </div> <!-- /.service -->
                        </div>

                        <div class="col-lg-4">
                            <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                                <div class="service-icon color-1 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                  <path d="M0 4.357V0l8 5 8-5v4.357L8 9.357 0 4.357zm0 2.422L8 11.779l8-5.999v5.42a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V6.779z"/>
                                </svg>
                                </div> <!-- /.icon -->
                                <div class="service-contents">
                                    <p>isstore36@gmail.com</p>
                                </div> <!-- /.service-contents-->
                            </div> <!-- /.service -->
                        </div>

                        <div class="col-lg-4">
                        <div class="service no-shadow align-items-center link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
                            <div class="service-icon color-1 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                                    <path d="M13 0a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1h10zM8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>
                            </div> <!-- /.icon -->
                            <div class="service-contents">
                                <p>+91 234 567 8803</p>
                            </div> <!-- /.service-contents-->
                        </div> <!-- /.service -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End location Section -->

    <!-- Start Map Section -->
    <div class="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3863.773132507918!2d79.99047537514917!3d14.440233886027322!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a4cf34c16623415%3A0x182167ce27aacded!2sChildrens%20Park%20Rd%2C%20Pinakini%20Avenue%2C%20Ramji%20Nagar%2C%20Nellore%2C%20Andhra%20Pradesh!5e0!3m2!1sen!2sin!4v1709659729705!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>
    </div><br><br>
    <!-- End Map Section -->

          		<!-- Start Message Section -->
              <h2><b>Write a Message</b></h2>
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin-bottom: 30px;">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="fname"><b>First name</b></label>
                      <input type="text" class="form-control" id="fname" name="fname" placeholder="Syed">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="lname"><b>Last name</b></label>
                      <input type="text" class="form-control" id="lname" name="lname" placeholder="Riya">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="email"><b>Email address</b></label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="riya_363@gmail.com">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="text-black" for="lname"><b>Mobile Number</label>
                      <input type="text" class="form-control" id="m_num" name="m_num" placeholder="9393939696">
                    </div>
                  </div>
                </div>
                <div class="form-group mb-5">
                  <label class="text-black" for="message"><b>Message</b></label>
                  <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Welcome to Izna Store's... Your thoughts, queries, and feedback are the colors that shape our journey together. Drop us a line; we're eager to hear from you."></textarea>
                </div>

                <button type="submit" class="btn btn-primary-hover-outline" name="button_temp">Send Message</button>
              </form>

            </div>

          </div>

        </div>

      </div>


    </div>
  </div>
  <!-- Start Message Section -->
		

		<!-- Start Footer Section -->
		<?php include 'footer.php'; ?>
		<!-- End Footer Section -->	


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
	</body>

</html>
