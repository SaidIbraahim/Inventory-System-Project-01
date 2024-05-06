<?php
include 'dbConnection.php'; // Include the db.php file to establish a database connection and access functions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Insert new customer into database
    $sql = "INSERT INTO customers (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if ($conn->query($sql) === TRUE) {
        // Customer added successfully
        header("Location: customers.php"); // Redirect back to customers.php after adding customer
        exit();
    } else {
        // Error adding customer
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If request method is not POST, redirect back to customers.php
    header("Location: customers.php");
    exit();
}
?>
