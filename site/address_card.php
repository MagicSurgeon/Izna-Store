<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); 
}

include 'data.php';
?>

<style>
@import url("https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext");

:root {
  --green: #3b5d50;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  user-select: none;
}


.card {
  border-radius: 10px;
  filter: drop-shadow(0 5px 10px 0 #ffffff);
  width: calc(100% - 20px); /* Adjusted width for two cards in one row */
  height: 250px;
  background-color: #ffffff;
  padding: 20px;
  position: relative;
  z-index: 0;
  overflow: hidden;
  transition: 0.6s ease-in;
  box-sizing: border-box; /* Added to ensure padding is included in the width */
  display: inline-block; /* Changed from flex to inline-block */
  margin-bottom: 20px; /* Added margin between cards */
}


.card::before {
  content: "";
  position: absolute;
  z-index: -1;
  top: -15px;
  right: -15px;
  background: #3b5d50;
  height:63px;
  width: 63px;
  border-radius: 32px;
  transform: scale(1);
  transform-origin: 50% 50%;
  transition: transform 0.25s ease-out;
}
.imgg{
  position: absolute;
  top: 0px;
  right: 0px;
  height:auto;
  width: 40px;
  border-radius: 62px;
}

.card:hover::before{
  transition-delay:0.2s ;
  transform: scale(40);
}

.card:hover{
    color: #ffffff;

}

.card p{
    padding: 10px 0;
}
.action__btn {
    display: flex;
    gap: 3rem;
  }

  .action__btn button {
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 2px;
    padding: 1rem rem;
    outline: none;
    border: 2px solid ;
    border-radius: 60px;
    transition: 0.3s;
    cursor: pointer;
  }

  .delete {
    background-color: var(--green);
    color: #fff ;
  }

  .delete:hover {
    background-color: var(--green);
    color: #FFD700 ;
  }

  .edit {
    background-color: var(--green);
    color: #FFD700 ;

  }

  .edit:hover {
    background-color: var(--green);
    color: #ffffff;
  }
  .row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
}


</style>
    <div class="row">
      <?php
          // Check if the user is logged in
          if (isset($_SESSION['user_id'])) {
              // Fetch data from the billing_address table for the logged-in user
              $user_id = $_SESSION['user_id'];
              $query = "SELECT id, user_id, c_nname, c_country, c_address, l_mark, c_state, c_postal_zip, c_email_address, c_phone, c_order_notes, created_at FROM billing_address WHERE user_id = $user_id";
              $result = mysqli_query($conn, $query);

              // Check if any rows are returned
              if (mysqli_num_rows($result) > 0) {
                  // Loop through each row of data
                  while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="card" style="width: 90%;">
            <img class="imgg" src="image/profile_icons/team.png" alt="">
            <h3 style="margin-left: 25px;"><?php echo $row['c_nname']; ?></h3>
            <h6><img src="image/profile_icons/love-letter.png" style="height: 20px; width: auto; margin-left: 27px;">       <?php echo $row['c_email_address']; ?> &nbsp;&nbsp;&nbsp;&nbsp;<img src="image/profile_icons/forward.png" style="height: 16px; width: auto;">       <?php echo $row['c_phone']; ?></h6>
            <p style="margin-bottom: -26px; margin-top: -6px; "><img src="image/profile_icons/location.png" style="height: 18px; width: auto; margin-left: 27px;">     <?php echo $row['c_address']; ?>,</p>
            <p style="margin-bottom: -26px; width: auto; margin-left: 47px; "><?php echo $row['l_mark']; ?>,</p>
            <p style="margin-bottom: -26px; width: auto; margin-left: 47px; "><?php echo $row['c_state']; ?> - <?php echo $row['c_postal_zip']; ?> , <?php echo $row['c_country']; ?>.</p><br>
            <div class="action__btn">
                <button class="edit" style="height:43px; width: 130px; margin-left:20px;">Edit</button>
                <button class="delete" style="height:43px; width: 130px;">Delete</button>
            </div>
        </div>
        <?php
          }
          } else {
                  echo "No billing address found for the user";
              }
          } else {
              echo "User is not logged in";
          }
        ?>
    </div>