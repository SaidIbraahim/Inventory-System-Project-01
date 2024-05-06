<?php
include 'dbConnection.php'; // Include the db.php file to establish a database connection and access functions

// Check if product_id is provided in the URL
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Delete product from database
    $sql = "DELETE FROM products WHERE product_id='$product_id'";
    if ($conn->query($sql) === TRUE) {
        // Product deleted successfully
        header("Location: productList.php"); // Redirect back to products.php after deleting product
        exit();
    } else {
        // Error deleting product
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If product_id is not provided, redirect back to products.php
    header("Location: productList.php");
    exit();
}
?>
