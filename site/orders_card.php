<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}


error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<style>
.card {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 320px;
  border-radius: 24px;
  line-height: 1.6;
  transition: all 0.64s cubic-bezier(0.23, 1, 0.32, 1);
  margin-bottom:40px;
}
.content-wrapper {
  display: flex;
  align-items: flex-start;
  gap: 24px;
  padding: 36px;
  border-radius: 24px;
  background: transparent;
  color: #000000;
  z-index: 1;
  transition: all 0.64s cubic-bezier(0.23, 1, 0.32, 1);
}
.card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  background-color: #3b5d50;
  border-radius: inherit;
  height: 100%;
  width: 100%;
  opacity: 0;
  transform: skew(-160deg);
  clip-path: circle(0% at 50% 50%);
  transition: all 1s cubic-bezier(0.23, 1, 0.32, 1);
}
.content{
  margin-left:160px;
  padding: 30px;
}
.content .heading {
  font-weight: 700;
  font-size: 36px;
  line-height: 1.3;
  z-index: 1;
}
.content .para {
  z-index: 1;
  opacity: 0.8;
  font-size: 18px;
}
.content .para-sm {
  font-size: 16px;
}
.card:hover::before {
  opacity: 1;
  transform: skew(0deg);
  clip-path: circle(150.9% at 0 0);
}
.card:hover .content-wrapper {
  color: #ffffff;
}
.card img {
  max-width: 100%;
  border-radius: 12px; 
}
.img{
  width: 190px;
  height:auto;
  margin-left:-160px;
}
.item-count {
  position: absolute;
  bottom: 239px;
  left: 400px;
  transform: translateX(-50%);
  background-color: #3b5d50;
  color: #fff;
  padding: 8px 18px;
  border-radius: 24px;
  font-size: 19px;
  font-weight: bold;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.6);
  transition: transform 0.3s ease;
}

.item-count:hover {
  background-color: #fff;
  color: #3b5d50;
  transform: scale(1.1);
}


</style>
<?php
$query = "SELECT product_images, product_name, product_customize, product_sprice, product_quantity, u_id, created_at, subtotal, total FROM cart ORDER BY created_at";
$result = mysqli_query($conn, $query);

// Initialize variables to keep track of the previous created_at date and item count
$prev_created_at = null;
$item_count = 0;

// Loop through the results and display them in the HTML template
while ($row = mysqli_fetch_assoc($result)) {
    // Check if the current created_at date is different from the previous one
    if ($row['created_at'] !== $prev_created_at) {
        // If this is not the first item and there were multiple items with the previous created_at date, display the snap tag
        if ($prev_created_at !== null && $item_count > 1) {
            echo '<div class="snap-tag">+' . ($item_count - 1) . '</div>';
        }
        
        // Reset the item count for the new created_at date
        $item_count = 1;
        
        // Update the previous created_at date
        $prev_created_at = $row['created_at'];
?>
<div class="card">
  <div class="content-wrapper">
    <img class="img" src="images/<?php echo $row['product_images']; ?>" alt="image">
    <!-- Modify the link to pass the u_id as a query parameter -->
    <a href="order_details.php?u_id=<?php echo $row['u_id']; ?>"><div class="item-count">+<?php echo $item_count; ?> Item's</div></a>
    <div class="content">
      <p class="heading"><?php echo $row['product_name']; ?></p>
      <p class="para para-sm">₹<?php echo $row['total']; ?></p>
      <p class="para">
        estimated delivery on <?php echo $row['created_at']; ?>
      </p>
      <p class="para para-sm"><?php echo $row['created_at']; ?></p>
    </div>
  </div>
</div>


<?php
    }
}

// After the loop, check if there were multiple items with the same created_at date for the last group
if ($prev_created_at !== null && $item_count > 1) {
    echo '<div class="snap-tag">+' . ($item_count - 1) . '</div>';
}
?>
