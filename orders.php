<?php include 'Navbar.php';
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to the login page
    header("Location: log_in.php");
    exit();
}
?>
<?php
include 'dbConnection.php'; // Include the db.php file to establish a database connection and access functions
$orders = getOrders($conn); // Call the getOrders function to fetch order data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Orders</h1>

        <!-- Display orders table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch orders data from database and loop through -->
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= $order['customer_id'] ?></td>
                        <td><?= $order['product_id'] ?></td>
                        <td><?= $order['quantity'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $order['order_id'] ?>">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteOrder(<?= $order['order_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add new order button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addOrderModal">
            Add New Order
        </button>

        <!-- Add new order modal -->
        <div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="addOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add new order form -->
                        <form action="add_order.php" method="post">
                            <div class="form-group">
                                <label for="customer_id">Customer ID</label>
                                <input type="text" class="form-control" id="customer_id" name="customer_id" required>
                            </div>
                            <div class="form-group">
                                <label for="product_id">Product ID</label>
                                <input type="text" class="form-control" id="product_id" name="product_id" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit order modals -->
        <!-- Loop through orders and create modals for editing each order -->
        <?php foreach ($orders as $order): ?>
            <div class="modal fade" id="editModal<?= $order['order_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $order['order_id'] ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?= $order['order_id'] ?>">Edit Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit order form -->
                            <form action="edit_order.php" method="post">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <div class="form-group">
                                    <label for="edit_customer_id<?= $order['order_id'] ?>">Customer ID</label>
                                    <input type="text" class="form-control" id="edit_customer_id<?= $order['order_id'] ?>" name="customer_id" value="<?= $order['customer_id'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_product_id<?= $order['order_id'] ?>">Product ID</label>
                                    <input type="text" class="form-control" id="edit_product_id<?= $order['order_id'] ?>" name="product_id" value="<?= $order['product_id'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_quantity<?= $order['order_id'] ?>">Quantity</label>
                                    <input type="number" class="form-control" id="edit_quantity<?= $order['order_id'] ?>" name="quantity" value="<?= $order['quantity'] ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- JavaScript function to handle order deletion -->
    <script>
        function deleteOrder(orderId) {
            if (confirm("Are you sure you want to delete this order?")) {
                // Redirect to delete_order.php with order_id parameter
                window.location.href = 'delete_order.php?order_id=' + orderId;
            }
        }
    </script>
</body>
</html>
