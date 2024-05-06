<?php
include 'dbConnection.php'; // Include the db.php file to establish a database connection and access functions

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Update product in database
    $sql = "UPDATE products SET name='$name', description='$description', price='$price' WHERE product_id='$product_id'";
    if ($conn->query($sql) === TRUE) {
        // Product updated successfully
        header("Location: productList.php"); // Redirect back to products.php after updating product
        exit();
    } else {
        // Error updating product
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If form is not submitted, redirect back to products.php
    header("Location: productList.php");
    exit();
}
?>
