<?php
include 'data.php';

// Function to update item status based on parameters
function updateItemStatus($conn, $tables, $idColumn, $statusColumn) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        foreach ($tables as $table) {
            // Update the database to mark the item as inactive
            $query = "UPDATE $table SET $statusColumn = 0 WHERE $idColumn = $id";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                // Handle error if the query fails
                echo "Error updating item status for table $table: " . mysqli_error($conn);
                return; // Stop processing further tables
            }
        }
        
        // Redirect back to the same page
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
}

// Call the function with the array of tables
updateItemStatus($conn, ['product', 'blog', 'contact_us'], 'id', 'is_active');
?>
