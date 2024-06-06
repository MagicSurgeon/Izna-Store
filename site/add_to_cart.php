<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}   
// Include your database connection
include 'data.php';

// Check if the product ID is provided in the request
if(isset($_POST['product_id'])) {
    // Sanitize the product ID to prevent SQL injection
    $product_id = intval($_POST['product_id']);
   $user_id=intval($_SESSION['user_id']);
    // Insert the product ID into the t_cart table
    $query = "INSERT INTO t_cart (product_id,user_id) VALUES (?,?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ii', $product_id, $user_id);
    
    // Execute the query
    if(mysqli_stmt_execute($stmt)) {
        // Return success message if the insertion is successful
        echo 'success';
    } else {
        // Return error message if the insertion fails
        echo 'error';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Return error message if product ID is not provided
    echo 'error';
}

// Close the database connection
mysqli_close($conn);
?>
