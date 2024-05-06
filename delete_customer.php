<?php
include 'dbConnection.php'; // Include the dbConnection.php file to establish a database connection and access functions

// Check if customer_id is provided in the URL
if(isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Delete customer from database
    $sql = "DELETE FROM customers WHERE customer_id='$customer_id'";
    if ($conn->query($sql) === TRUE) {
        // Customer deleted successfully
        header("Location: customers.php"); // Redirect back to customers.php after deleting customer
        exit();
    } else {
        // Error deleting customer
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If customer_id is not provided, redirect back to customers.php
    header("Location: customers.php");
    exit();
}
?>
