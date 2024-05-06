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
$products = getProducts($conn); // Call the getProducts function to fetch product data
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Products</h1>

        <!-- Display products table -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch products data from database and loop through -->
                <?php
                // Assuming $products is an array containing product data fetched from database
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>{$product['product_id']}</td>";
                    echo "<td>{$product['name']}</td>";
                    echo "<td>{$product['description']}</td>";
                    echo "<td>{$product['price']}</td>";
                    echo "<td>";
                    echo "<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#editModal{$product['product_id']}'>Edit</button> ";
                    echo "<button class='btn btn-sm btn-danger' onclick='deleteProduct({$product['product_id']})'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Add new product button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
            Add New Product
        </button>

        <!-- Add new product modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add new product form -->
                        <form action="add_product.php" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit product modals -->
        <!-- Loop through products and create modals for editing each product -->
        <?php foreach ($products as $product): ?>
            <div class="modal fade" id="editModal<?=$product['product_id']?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?=$product['product_id']?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?=$product['product_id']?>">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Edit product form -->
                            <form action="edit_product.php" method="post">
                                <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
                                <div class="form-group">
                                    <label for="edit_name<?=$product['product_id']?>">Name</label>
                                    <input type="text" class="form-control" id="edit_name<?=$product['product_id']?>" name="name" value="<?=$product['name']?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_description<?=$product['product_id']?>">Description</label>
                                    <textarea class="form-control" id="edit_description<?=$product['product_id']?>" name="description" rows="3" required><?=$product['description']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="edit_price<?=$product['product_id']?>">Price</label>
                                    <input type="number" class="form-control" id="edit_price<?=$product['product_id']?>" name="price" value="<?=$product['price']?>" required>
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

    <!-- JavaScript function to handle product deletion -->
    <script>
    function deleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            // Redirect to delete_product.php with product_id parameter
            window.location.href = 'delete_product.php?product_id=' + productId;
        }
    }
</script>


</body>
</html>
