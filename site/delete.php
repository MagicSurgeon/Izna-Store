<?php
include 'data.php'; // Include file to establish database connection

// Check if ID is provided
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete item from the 'tempi' table based on ID
    $delete_query = "DELETE FROM t_cart WHERE id = $id";
    mysqli_query($conn, $delete_query);

    // Redirect back to cart.php after deleting the item
    header("Location: cart.php");
    exit();
} else {
    // Redirect to cart.php if ID is not provided
    header("Location: cart.php");
    exit();
}
?>
