<?php
include 'dbConnection.php'; // Include the db.php file to establish a database connection and access functions

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Insert new product into database
    $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";
    if ($conn->query($sql) === TRUE) {
        // Product added successfully
        header("Location: productList.php"); // Redirect back to products.php after adding product
        exit();
    } else {
        // Error adding product
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If form is not submitted, redirect back to products.php
    header("Location: productList.php");
    exit();
}
?>
