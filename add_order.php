<?php
include 'dbConnection.php'; // Include the dbConnection.php file to establish a database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Insert new order into the database
    $sql = "INSERT INTO orders (customer_id, product_id, quantity) VALUES ('$customer_id', '$product_id', '$quantity')";
    if ($conn->query($sql) === TRUE) {
        // Order added successfully
        header("Location: orders.php"); // Redirect back to orders.php after adding order
        exit();
    } else {
        // Error adding order
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If form is not submitted, redirect back to orders.php
    header("Location: orders.php");
    exit();
}
?>
