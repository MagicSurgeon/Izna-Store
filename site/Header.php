<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}

include 'data.php'; 

// Fetch count of items in the cart from the t_cart table
$count_query = "SELECT COUNT(id) AS cart_count FROM t_cart";
$count_result = mysqli_query($conn, $count_query);
$cart_count = 0; // Initialize cart count variable

if ($count_result && mysqli_num_rows($count_result) > 0) {
    $count_row = mysqli_fetch_assoc($count_result);
    $cart_count = $count_row['cart_count'];
}

$user = null;
$profile_photo = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT name, m_num, gmail, gender, profile_photo FROM new_user WHERE user_id='$user_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (!empty($user['profile_photo'])) {
            $profile_photo = $user['profile_photo'];
        } else {
            if ($user['gender'] == 'female') {
                $profile_photo = 'https://wallpapers.com/images/hd/pretty-profile-pictures-2tkqwa8t2rolierf.jpg';
            } else {
                $profile_photo = 'https://img.freepik.com/premium-photo/anime-boy-reading-book-with-cat-beside-him_864588-27636.jpg';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="image\logo.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet">
</head>
<body>
<!-- Start Header/Navigation -->
<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="navigation bar">
    <div class="container">
        <a class="navbar-brand" href="">Izna Store<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbars">
            <?php
            $current_page = basename($_SERVER['PHP_SELF']);
            ?>

            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'shop.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="shop.php">Shop</a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="about.php">About us</a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="services.php">Services</a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'blog.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">Contact us</a>
                </li>
            </ul>

            <!-- Start Profile Section -->
            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <?php if (isset($_SESSION['user_id']) && $user): ?>
                    <li>
                        <div class="action">
                            <div class="profile" onclick="menuToggle();">
                                <img src="<?php echo $profile_photo; ?>" alt="profile">
                            </div>
                            <div class="menu">
                                <h3><span>Welcome</span> <br> <b><?php echo $user['name']; ?></b></h3>
                                <ul>
                                    <li><img src="image/profile_icons/team.png"><a href="my_profile.php">My Profile</a></li>
                                    <li><img src="image/profile_icons/edit_c.png"><a href="edit_profile.php">Edit Profile</a></li>
                                    <li><img src="image/profile_icons/online-shopping.png"><a href="orders.php">Orders</a></li>
                                    <li><img src="image/profile_icons/settings.png"><a href="#">Settings</a></li>
                                    <li><img src="image/profile_icons/question.png"><a href="#">Help</a></li>
                                    <li><img src="image/profile_icons/log-out.png"><a href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                <?php else: ?>
                    <li>
                        <div class="action">
                            <div class="profile" onclick="menuToggle();">
                                <img src="image/icons/user.svg" alt="profile" style="width: auto; height: 30px; margin-left: 7px;">
                            </div>
                            <div class="menu">
                                <h3>Login first<br><span>Order Fast</span></h3>
                                <ul>
                                    <li><img src="image/profile_icons/key.png"><a href="login.php">Login</a></li>
                                    <li><img src="image/profile_icons/new-customer.png"><a href="signup.php">Sign-up</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <!-- End Profile Section -->

                <!-- Start Cart Section -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li style="position: relative; top:4px;">
                        <a class="nav-link" href="cart.php">
                            <img src="image/icons/cart.svg" style="width: auto; height: 30px; margin-top: -5px;">
                            <?php if ($cart_count > 0): ?>
                                <span style="position: absolute; top: 3px; right: 3px; transform: translate(50%, -50%); background-color: #FFD700; color: #3b5d50; border-radius: 50%; width: 19px; height: 19px; line-height: 19px; text-align: center; font-size: 13px;"><?php echo $cart_count; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li></li>
                <?php endif; ?>
                <!-- End Cart Section -->
            </ul>
        </div>
    </div>
</nav>
<!-- End Header/Navigation -->

<script>
    // JavaScript function to toggle the dropdown menu
    function menuToggle() {
        const toggleMenu = document.querySelector('.menu');
        toggleMenu.classList.toggle('active');
    }

    // Get the profile and menu elements
    const profile = document.querySelector('.profile');
    const menu = document.querySelector('.menu');

    // Add event listeners for hover on both profile and menu elements
    profile.addEventListener('mouseenter', function() {
        // Show the menu when the cursor enters the profile area
        menuToggle();
    });

    profile.addEventListener('mouseleave', function(event) {
        // Check if the cursor is still within the menu area
        if (!menu.contains(event.relatedTarget)) {
            // Hide the menu when the cursor leaves the profile area and the menu area
            menuToggle();
        }
    });

    menu.addEventListener('mouseleave', function(event) {
        // Check if the cursor is still within the profile area
        if (!profile.contains(event.relatedTarget)) {
            // Hide the menu when the cursor leaves the menu area and the profile area
            menuToggle();
        }
    });
</script>
</body>
</html>
