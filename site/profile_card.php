<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}

include 'data.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "User ID not set.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap");
        :root {
            --primary-color: #3b5d50;
            --primary-color-dark: #3b5d50;
            --secondary-color: #ca8a04;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --max-width: 1200px;
        }

        .section__container {
            max-width: var(--max-width);
            margin: auto;
            padding: 1rem;
            margin-top: -10px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 4rem;
        }

        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .subtitle {
            letter-spacing: 2px;
            color: var(--text-light);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 400;
            line-height: 3rem;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .title span {
            font-weight: 600;
        }

        .description {
            width: 660px;
            line-height: 1.5rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            text-align: justify;
        }

        .action__btns {
            display: flex;
            gap: 3rem;
        }

        .action__btns button {
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 2px;
            padding: 1rem 3rem;
            outline: none;
            border: 2px solid var(--primary-color);
            border-radius: 60px;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn_1 {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn_1:hover {
            background-color: #ffffff;
            color: var(--primary-color);
        }

        .btn_2 {
            color: var(--primary-color);
        }

        .btn_2:hover {
            background-color: var(--primary-color-dark);
            color: #ffffff;
        }

        .image {
            display: grid;
            place-items: center;
            width: 500px;
            height: 500px;
        }

        .image img {
            width: min(26.5rem, 90%);
            height: min(25rem, 90%);
            border-radius: 100%;
            transition: transform 0.3s ease, border 0.3s ease;
        }

        .image img:hover {
            transform: scale(1.03); 
            border: 13px solid var(--primary-color); 
            color: #ffffff; 
        }

    </style>
</head>
<body>
    <div class="section__container">
        <div class="content">
            <?php
            $sql = "SELECT name, m_num, gmail, dob, gender, profile_photo FROM new_user WHERE user_id='$user_id'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row["name"];
                    $m_num = $row["m_num"];
                    $gmail = $row["gmail"];
                    $dob = $row["dob"];
                    $gender = $row["gender"];
                    $profile_photo = $row["profile_photo"];
                    
                    if (empty($profile_photo)) {
                        // Correcting default profile photo URLs
                        if ($gender == 'female') {
                            $profile_photo = 'https://wallpapers.com/images/hd/pretty-profile-pictures-2tkqwa8t2rolierf.jpg';
                        } else {
                            $profile_photo = 'https://img.freepik.com/premium-photo/anime-boy-reading-book-with-cat-beside-him_864588-27636.jpg';
                        }
                    }
                    ?>
                    <p class="subtitle">HELLO</p>
                    <h1 class="title">
                        Mr./Ms. <span><?php echo $name; ?></span>
                    </h1>
                    <h5 class="description">
                        Mobile - <?php echo $m_num; ?> <br><br>
                        Email - <?php echo $gmail; ?> <br><br>
                        Date Of Birth - <?php echo $dob; ?> <br><br>
                        Gender - <?php echo $gender; ?> <br><br>
                    </h5>
                    <p class="description">
                        "Welcome to Izna Store, where resin art meets imagination! 🎨 Dive into a world of exquisite handcrafted designs that blend creativity with craftsmanship.
                        From elegant jewelry pieces to stunning home decor, our curated collection showcases the beauty of resin in every form.<br>
                        Indulge in unique, one-of-a-kind creations that add a touch of artistry to your life.
                        Join our community of art enthusiasts and explore the boundless possibilities of resin crafting." <br><br>
                        "Experience the allure of Izna Store – where passion shapes resin into extraordinary masterpieces."
                    </p>
                    <div class="action__btns">
                        <a href="orders.php"><button class="btn_1">Orders</button></a>
                        <a href="shop.php"><button class="btn_2">Shop</button></a>
                        <a href="edit_profile.php"><button class="btn_1">Edit Profile</button></a>    
                    </div>
                </div>
                <div class="image">
                    <img src="<?php echo $profile_photo; ?>" alt="profile" />
                </div>
                <?php
                }
            } else {
                echo "No results found.";
            }
            ?>
    </div>
</body>
</html>
