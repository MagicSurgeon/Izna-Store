<?php
include 'data.php';

// Assuming $conn is your database connection

// Perform deletion query
$sql = "DELETE FROM t_cart";
if(mysqli_query($conn, $sql)) {
    echo 'success'; // Return success if deletion is successful
} else {
    echo 'error'; // Return error if deletion fails
}

// Close database connection
mysqli_close($conn);
?>
