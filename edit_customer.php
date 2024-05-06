<?php
include 'dbConnection.php'; // Include the db.php file to establish a database connection and access functions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $customer_id = $_POST['customer_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update customer in the database
    $sql = "UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE customer_id='$customer_id'";
    if ($conn->query($sql) === TRUE) {
        // Customer updated successfully
        header("Location: customers.php"); // Redirect back to customers.php after updating customer
        exit();
    } else {
        // Error updating customer
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If request method is not POST, redirect back to customers.php
    header("Location: customers.php");
    exit();
}
?>
