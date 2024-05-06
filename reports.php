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
include 'dbConnection.php'; 

// Fetch data for generating reports (you can customize this based on your requirements)
$products = getProducts($conn);
$customers = getCustomers($conn);
$orders = getOrders($conn);

// Example: Total number of products
$totalProducts = count($products);

// Example: Total number of customers
$totalCustomers = count($customers);

// Example: Total number of orders
$totalOrders = count($orders);

// Example: Total revenue
$totalRevenue = 0;
foreach ($orders as $order) {
    // Check if product exists in $products array
    if (isset($products[$order['product_id']])) {
        // Calculate total revenue by summing the price of each product multiplied by its quantity in each order
        $totalRevenue += $order['quantity'] * $products[$order['product_id']]['price'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Reports</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h3>Inventory Reports</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text"><?php echo $totalProducts; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Customers</h5>
                        <p class="card-text"><?php echo $totalCustomers; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text"><?php echo $totalOrders; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <p class="card-text">$<?php echo number_format($totalRevenue, 2); ?></p>
                    </div>
                </div>
            </div>
            <!-- Add more reports as needed -->
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
