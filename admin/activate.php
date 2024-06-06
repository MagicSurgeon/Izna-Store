<?php
include 'data.php';

// Function to update item status to active based on parameters
function activateItem($conn, $tables, $idColumn, $productId) {
    foreach ($tables as $table) {
        // Update the 'is_active' column to 1 (active) for the selected item in each table
        $updateQuery = "UPDATE $table SET is_active = 1 WHERE $idColumn = $productId";
        $result = mysqli_query($conn, $updateQuery);

        if (!$result) {
            // Handle error if the query fails for any table
            echo "Error activating item in table $table: " . mysqli_error($conn);
        }
    }

    // Redirect back to the previous page after all updates are done
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}

// Call the function with the appropriate parameters
activateItem($conn, ['product', 'blog', 'contact_us'], 'id', $_GET['id']);
?>
