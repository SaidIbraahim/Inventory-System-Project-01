<?php
include 'dbConnection.php'; // Include the dbConnection.php file to establish a database connection

// Check if order_id is provided in the URL
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Delete order from database
    $sql = "DELETE FROM orders WHERE order_id='$order_id'";
    if ($conn->query($sql) === TRUE) {
        // Order deleted successfully
        header("Location: orders.php"); // Redirect back to orders.php after deleting order
        exit();
    } else {
        // Error deleting order
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If order_id is not provided, redirect back to orders.php
    header("Location: orders.php");
    exit();
}
?>
