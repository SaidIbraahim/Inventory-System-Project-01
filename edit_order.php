<?php
include 'dbConnection.php';

// Check if order_id is provided in the URL
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve order details from the database
    $sql = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $order = $result->fetch_assoc(); // Fetch the order details

        // Check if form is submitted for updating order
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customer_id = $_POST['customer_id'];
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            // Debugging: Output POST data
            echo "POST data: <pre>";
            print_r($_POST);
            echo "</pre>";

            // Update order in the database
            $update_sql = "UPDATE orders SET customer_id='$customer_id', product_id='$product_id', quantity='$quantity' WHERE order_id='$order_id'";
            echo "Update SQL: $update_sql";

            if ($conn->query($update_sql) === TRUE) {
                // Order updated successfully
                echo "Order updated successfully!";
                header("Location: orders.php"); // Redirect back to orders.php after updating order
                exit();
            } else {
                // Error updating order
                echo "Error: " . $update_sql . "<br>" . $conn->error;
            }
        }
    } else {
        // Order not found
        echo "Order not found.";
    }
} else {
    // If order_id is not provided, redirect back to orders.php
    header("Location: orders.php");
    exit();
}
?>
 