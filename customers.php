<?php include 'Navbar.php';
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to the login page
    header("Location: log_in.php");
    exit();
}
include 'dbConnection.php'; // Include the db.php file to establish a database connection and access functions
$customers = getCustomers($conn); // Call the getCustomers function to fetch customer data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Customers</h1>

        <!-- Display customers table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch customers data from database and loop through -->
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= $customer['customer_id'] ?></td>
                        <td><?= $customer['name'] ?></td>
                        <td><?= $customer['email'] ?></td>
                        <td><?= $customer['phone'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $customer['customer_id'] ?>">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteCustomer(<?= $customer['customer_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Add new customer button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCustomerModal">
            Add New Customer
        </button>

        <!-- Add new customer modal -->
        <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add new customer form -->
                        <form action="add_customer.php" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Customer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit customer modals -->
        <!-- Loop through customers and create modals for editing each customer -->
        <?php foreach ($customers as $customer): ?>
            <div class="modal fade" id="editModal<?= $customer['customer_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $customer['customer_id'] ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?= $customer['customer_id'] ?>">Edit Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit customer form -->
                            <form action="edit_customer.php" method="post">
                                <input type="hidden" name="customer_id" value="<?= $customer['customer_id'] ?>">
                                <div class="form-group">
                                    <label for="edit_name<?= $customer['customer_id'] ?>">Name</label>
                                    <input type="text" class="form-control" id="edit_name<?= $customer['customer_id'] ?>" name="name" value="<?= $customer['name'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_email<?= $customer['customer_id'] ?>">Email</label>
                                    <input type="email" class="form-control" id="edit_email<?= $customer['customer_id'] ?>" name="email" value="<?= $customer['email'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_phone<?= $customer['customer_id'] ?>">Phone</label>
                                    <input type="text" class="form-control" id="edit_phone<?= $customer['customer_id'] ?>" name="phone" value="<?= $customer['phone'] ?>" required>
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

    <!-- JavaScript function to handle customer deletion -->
    <script>
        function deleteCustomer(customerId) {
            if (confirm("Are you sure you want to delete this customer?")) {
                // Redirect to delete_customer.php with customer_id parameter
                window.location.href = 'delete_customer.php?customer_id=' + customerId;
            }
        }
    </script>
</body>
</html>
