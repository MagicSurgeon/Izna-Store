<?php
session_start();
include 'data.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$userId = $_SESSION['user_id'];

$sql = "SELECT username, profile_image FROM users WHERE admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found";
    exit;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izna Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style/header.css">
    <style>
        /* Profile dropdown CSS */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap");
        @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css");

        :root {
            --primary: #eeeeee;
            --secondary: #227c70;
            --green: #82cd47;
            --secondary-light: rgba(34, 124, 112, 0.2);
            --secondary-light-2: rgba(127, 183, 126, 0.1);
            --white: #fff;
            --black: #393e46;
            --shadow: 0px 2px 8px 0px var(--secondary-light);
        }

        .profile{
            display: flex;
            align-content: center;
            justify-content: space-evenly;
            align-items: center;
            gap: 34px;
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-dropdown-btn, .auth-btns {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-right: 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            width: fit-content;
            border-radius: 50px;
            color: var(--black);
            cursor: pointer;
            border: 1px solid var(--secondary);
            transition: box-shadow 0.2s ease-in, background-color 0.2s ease-in, border 0.3s;
        }

        .profile-dropdown-btn:hover, .auth-btns:hover {
            background-color: var(--secondary-light-2);
            box-shadow: var(--shadow);
        }

        .profile-img {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background-size: cover;
            position: relative;
        }

        .profile-img i {
            position: absolute;
            right: 0;
            bottom: 0.3rem;
            font-size: 0.5rem;
            color: var(--green);
        }

        .profile-dropdown-btn span {
            margin: 0 0.5rem;
            margin-right: 0;
            font-size: 20px;
        }

        .profile-dropdown-list {
            position: absolute;
            top: 60px;
            width: 220px;
            right: -13px;
            background-color: var(--white);
            border-radius: 10px;
            max-height: 0;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: max-height 0.5s;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-dropdown-list.active {
            max-height: 500px;
        }

        .profile-dropdown-list-item {
            padding: 0.5rem 1rem;
            transition: background-color 0.2s ease-in, padding-left 0.2s;
        }

        .profile-dropdown-list-item a {
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--black);
        }

        .profile-dropdown-list-item a i {
            margin-right: 0.8rem;
            font-size: 1.1rem;
            width: 2.3rem;
            height: 2.3rem;
            background-color: var(--secondary);
            color: var(--white);
            line-height: 2.3rem;
            text-align: center;
            border-radius: 50%;
        }

        .profile-dropdown-list-item:hover {
            padding-left: 1.5rem;
            background-color: var(--secondary-light);
        }

        .profile-dropdown-list hr {
            border: 0.5px solid var(--green);
            margin: 0.5rem 0;
        }
    </style>
</head>
<body>
    <div class="head">
            <nav class="navbar bg-body-tertiary fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="">
                        <img src="Images/Logo.png" alt="Logo" style="width: 99px;">
                    </a>
                <div class="profile">
                <!-- Start Profile deopdown -->
                    <div class="profile-dropdown">
                        <div class="profile-dropdown-btn" id="profileSection">
                            <div class="profile-img" id="profileImg" style="background-image: url('<?php echo htmlspecialchars($user['profile_image']); ?>');">
                            </div>
                            <span id="username"><?php echo htmlspecialchars($user['username']); ?> <i class="fa-solid fa-angle-down"></i></span>
                        </div>
                        <div class="auth-btns" id="authSection" style="display: none;">
                            <span><a href="#">Login</a> | <a href="#">Signup</a></span>
                        </div>
                        <ul class="profile-dropdown-list">
                            <li class="profile-dropdown-list-item">
                                <a href="profile_view.php">
                                    <i class="fa-regular fa-user"></i>
                                    View Profile
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="edit_profile.php">
                                    <i class="fa-solid fa-user-pen"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="#">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Analytics
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="#">
                                    <i class="fa-solid fa-sliders"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="profile-dropdown-list-item">
                                <a href="#">
                                    <i class="fa-regular fa-circle-question"></i>
                                    Help & Support
                                </a>
                            </li>
                            <hr />
                            <li class="profile-dropdown-list-item">
                                <a href="logout.php">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                <!-- End Profile deopdown -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel" ><i class="bi bi-shop" style="margin: 0 0 0 7px; gap: 11px; font-size: 19px; "> I Store</i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <form class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form><br>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" style="margin: 0 0 0 7px; gap: 11px; font-size: 19px; ">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php"><i class="bi bi-house-heart"> Dashboard</i></a>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-cart3"> Shop</i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="add_items_shop.php">Add Item</a></li>
                                    <li><a class="dropdown-item" href="view_items_shop.php">View Items</a></li>
                                    <li><a class="dropdown-item" href="inactive_items_shop.php">View Inactive Items</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-cart3"> Category</i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="add_category.php">Add Category</a></li>
                                    <li><a class="dropdown-item" href="view_category.php">View Category</a></li>
                                    <li><a class="dropdown-item" href="inactive_category.php">View Inactive Category</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-substack"> Blog</i> 
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="add_blog.php">Add Blog</a></li>
                                    <li><a class="dropdown-item" href="view_blog.php">View Blog</a></li>
                                    <li><a class="dropdown-item" href="inactive_blogs.php">View Inactive Blog</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown"> 
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-chat-heart"> Contact Us</i> 
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="contact_us.php">View Message</a></li>
                                    <li><a class="dropdown-item" href="seen_messages.php">Seen Messages</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="bi bi-bag-heart"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div><br>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let profileDropdownList = document.querySelector(".profile-dropdown-list");
            let profileSection = document.getElementById("profileSection");
            let authSection = document.getElementById("authSection");

            let classList = profileDropdownList.classList;
            
            const toggleDropdown = () => classList.toggle("active");

            window.addEventListener("click", function (e) {
                if (!profileSection.contains(e.target)) {
                    classList.remove("active");
                }
            });

            let isLoggedIn = <?php echo json_encode(isset($_SESSION['user_id'])); ?>;

            if (isLoggedIn) {
                profileSection.style.display = "flex";
                authSection.style.display = "none";
            } else {
                profileSection.style.display = "none";
                authSection.style.display = "flex";
            }

            profileSection.addEventListener("click", toggleDropdown);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
