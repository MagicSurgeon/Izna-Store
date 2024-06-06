<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); 
}   
include 'data.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Retrieve user_id from session
    } else {
        header("Location: login.php");
        exit("User session not found. Please log in.");
    }
    // Retrieve form data for billing address
    $c_nname = $_POST['c_nname'];
    $c_country = $_POST['c_country'];
    $c_address = $_POST['c_address'];
    $l_mark = isset($_POST['l_mark']) ? $_POST['l_mark'] : null;
    $c_state = $_POST['c_state'];
    $c_postal_zip = $_POST['c_postal_zip'];
    $c_email_address = $_POST['c_email_address'];
    $c_phone = $_POST['c_phone'];
    $c_order_notes = isset($_POST['c_order_notes']) ? $_POST['c_order_notes'] : null;
    $subtotals = $_POST['subtotals'];

    // Additional data for billing address
    $created_at = date('Y-m-d H:i:s');

    // Insert data into billing_address table
    $query = "INSERT INTO billing_address (user_id, c_nname, c_country, c_address, l_mark, c_state, c_postal_zip, c_email_address, c_phone, c_order_notes, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement for billing address
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssss", $user_id, $c_nname, $c_country, $c_address, $l_mark, $c_state, $c_postal_zip, $c_email_address, $c_phone, $c_order_notes, $created_at);

    // Execute the query
    if ($stmt->execute()) {
        // Get the ID of the newly inserted row in billing_address table
        $billing_address_id = $conn->insert_id; // This will give you the ID of the last inserted row

        $cart_query = "INSERT INTO cart (u_id, user_id, product_name, product_sprice, product_images, product_quantity, product_customize, subtotal, total, created_at)
        SELECT ?, ?, product.product_name, product.product_sprice, product.product_images, t_cart.quantity, t_cart.customize, product.product_sprice * t_cart.quantity, SUM(product.product_sprice * t_cart.quantity) OVER() AS total, NOW()
        FROM t_cart
        INNER JOIN product ON t_cart.product_id = product.id
        WHERE t_cart.user_id = ?";

        // Prepare and execute the statement for cart
        $cart_stmt = $conn->prepare($cart_query);
        $cart_stmt->bind_param("iii", $billing_address_id, $user_id, $user_id);



        if ($cart_stmt->execute()) {
            // Redirect to thank you page or show success message
            header("Location: thankyou.php");
            exit();
        } else {
            // Handle insertion failure for cart
            echo "Error inserting data into cart: " . $conn->error;
        }

        // Close statement for cart
        $cart_stmt->close();
    } else {
        // Handle insertion failure for billing address
        echo "Error inserting data into billing address: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
