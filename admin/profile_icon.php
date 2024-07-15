<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dropdown</title>
    <style>
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
            width: 150px;
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
        }

        .profile-dropdown-list {
            position: absolute;
            top: 68px;
            width: 220px;
            right: 49px;
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
    <div class="profile-dropdown">
        <div class="profile-dropdown-btn" id="profileSection" style="display: none;">
            <div class="profile-img" id="profileImg">
                <i class="fa-solid fa-circle"></i>
            </div>
            <span id="username">Victoria <i class="fa-solid fa-angle-down"></i></span>
        </div>
        <div class="auth-btns" id="authSection" style="display: none;">
            <span><a href="#">Login</a> | <a href="#">Signup</a></span>
        </div>
        <ul class="profile-dropdown-list">
            <li class="profile-dropdown-list-item">
                <a href="#">
                    <i class="fa-regular fa-user"></i>
                    Edit Profile
                </a>
            </li>
            <li class="profile-dropdown-list-item">
                <a href="#">
                    <i class="fa-regular fa-envelope"></i>
                    Inbox
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
                <a href="#">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Log out
                </a>
            </li>
        </ul>
    </div>

    <script>
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let profileSection = document.getElementById("profileSection");
        let authSection = document.getElementById("authSection");

        let classList = profileDropdownList.classList;
        
        const toggle = () => classList.toggle("active");

        window.addEventListener("click", function (e) {
            if (!profileSection.contains(e.target)) classList.remove("active");
        });

        // Simulated login status (replace this with real login status check)
        let isLoggedIn = true;  // Change this to false to simulate a logged-out state

        if (isLoggedIn) {
            profileSection.style.display = "flex";
            authSection.style.display = "none";

            // Set user-specific information
            document.getElementById("username").innerHTML = "Victoria <i class='fa-solid fa-angle-down'></i>";
            document.getElementById("profileImg").style.backgroundImage = "url(./assets/profile-pic.jpg)";
        } else {
            profileSection.style.display = "none";
            authSection.style.display = "flex";
        }

        profileSection.addEventListener("click", toggle);
    </script>
</body>
</html>
