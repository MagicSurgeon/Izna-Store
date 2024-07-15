
<style>
    /* Custom CSS */
    body {
      background-color: #f8f9fa; /* Light background color */
    }
    .container {
      margin-top: 16px; /* Centers the container */
      background-color: #f3f7f7; /* Light blue container */
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }

    /* Ensure all form controls have the same width */
    .form-control {
      width: 100%;
    }

    /* Custom button styles */
    .btn-primary {
      background-color: #ff6b6b; /* Red */
      border-color: #ff6b6b; /* Red */
    }

    .btn-primary:hover {
      background-color: #ee5253; /* Darker red on hover */
      border-color: #ee5253; /* Darker red on hover */
    }

    /* MRP width */
    #inputAddress2 {
      width: 100%;
    }
    #inputCity,
    #inputState,
    #inputZip {
    width: 60%;
    }

    /* Center align submit and reset buttons */
    .btn-group {
      display: flex;
      justify-content: center;
    }
    /* Navbar css for untill navbar-brand  */
    .head {
        background-color: #add8e6; /* Light Blue background color for the header */
    }

    .navbar {
        background-color: #e3f2fd;
    }
    .logoo {
        max-height: 50px;
    }
     /* Center the navbar text */
    .navbar-brand {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4CAF50; 
    }
    /* CSS to automatically open dropdown on hover with transition */
    .dropdown:hover .dropdown-menu {
        display: block;
    }
    .profile{
        display: flex;
        gap: 20px;
    }
  </style>   

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<div class="head">
    <nav class="navbar bg-body-tertiary fixed-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href=""><img src="Images/Logo.png" class="logoo"></a>

            <div class="profile">
                <?php include 'profile_icon.php'; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="bi bi-shop">   I Store</i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>&nbsp;&nbsp;&nbsp;
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
                                <!-- Add more sub-items as needed -->
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
                                <!-- Add more sub-items as needed -->
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
                                <!-- Add more sub-items as needed -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown"> 
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-chat-heart"> Contact Us</i> 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="contact_us.php">View Message</a></li>
                                <li><a class="dropdown-item" href="seen_messages.php">Seen Message's</a></li>
                                <!-- Add more sub-items as needed -->
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href=""><i class="bi bi-bag-heart">   </i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
