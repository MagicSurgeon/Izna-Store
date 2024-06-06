<?php
include 'data.php';
?>

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
      margin-top:50px;
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

    .hire__me {
      background-color: var(--primary-color);
      color: #fff ;
    }

    .hire__me:hover {
      background-color: var(--primary-color-dark);
    }

    .portfolio {
      color: var(--primary-color);
    }

    .portfolio:hover {
      background-color: var(--primary-color-dark);
      color: #ffffff;
    }

    .image {
      display: grid;
      place-items: center;
    }

    .image img {
      width: min(26rem, 90%);
      border-radius: 100%;
    }
  </style>

<div class="content">
<?php
$sql = "SELECT name, m_num, gmail FROM new_user";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Accessing individual fields of the row
        $name = $row["name"];
        $m_num = $row["m_num"];
        $gmail = $row["gmail"];
        ?>
        
    <p class="subtitle">HELLO</p>
    <h1 class="title">
        Mr.\Ms. <span><?php echo $row['name']; ?><br /></span> <?php ?>
    </h1>
        <p class="description">
        Welcome to Izna Store, where resin art meets imagination! 🎨 Dive into a world of exquisite handcrafted designs that blend creativity with craftsmanship.
        From elegant jewelry pieces to stunning home decor, our curated collection showcases the beauty of resin in every form.<br>
        Indulge in unique, one-of-a-kind creations that add a touch of artistry to your life.
        Join our community of art enthusiasts and explore the boundless possibilities of resin crafting. <br><br>
        Experience the allure of Izna Store – where passion shapes resin into extraordinary masterpieces.
        </p>
    <div class="action__btns">
        <a href="orders.php"><button class="hire__me">Orders</button></a>
        <a href="shop.php"><button class="portfolio">Shop</button></a>    
    </div>
    <?php
  }
} else {
    echo "0 results"; 
}
?>
</div>
<div class="image">
    <img src="image/heart.png" alt="profile" />
</div>