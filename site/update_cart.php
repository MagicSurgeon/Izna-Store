<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}   
include 'data.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data sent from the client-side
    $productsData = json_decode($_POST['productsData'], true);
    
    // Get the user ID from the session
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    // Check if user ID is available
    if (!$user_id) {
        // If user ID is not available, return an error response
        echo json_encode(array('error' => 'User ID not found in session.'));
        exit;
    }
    
    // Clear existing data from t_cart table
    $clearQuery = "TRUNCATE TABLE t_cart"; // Warning: Truncates the entire table
    $clearResult = mysqli_query($conn, $clearQuery);
    
    if (!$clearResult) {
        // If clearing the table fails, return an error response
        echo json_encode(array('error' => 'Failed to clear cart data.'));
        exit;
    }
    
    // Insert new data into t_cart table
    foreach ($productsData as $product) {
        // Sanitize input
        $productId = mysqli_real_escape_string($conn, $product['productId']);
        $quantity = mysqli_real_escape_string($conn, $product['product_quantity']);
        $customize = mysqli_real_escape_string($conn, $product['product_customize']);
        $created_at = date('Y-m-d H:i:s');

        // Insert new record for each product
        $insertQuery = "INSERT INTO t_cart (product_id, quantity, customize, user_id, created_at) VALUES (?, ?, ?, ?, ?)";
        $statement = $conn->prepare($insertQuery);
        $statement->bind_param("iisss", $productId, $quantity, $customize, $user_id, $created_at);
        $statement->execute();
        
        if ($statement->error) {
            // If insertion fails, log the error
            error_log("Error inserting product: " . $statement->error);
        }
        
        $statement->close();
    }
    
    // Return a success response after updating the cart
    echo json_encode(array('success' => true));
} else {
    // If the request method is not POST, return an error response
    echo json_encode(array('error' => 'Invalid request method'));
}
?>
