<?php
session_start();

// Include database connection
include 'dbConnection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['full_name'];
    $password = $_POST['password'];

    // Query to check if user exists with the provided username and password
    $sql = "SELECT * FROM users WHERE full_name='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Check if user exists
    if ($result->num_rows == 1) {
        // User found, set session variables and redirect to index.php file
        $_SESSION['loggedin'] = true;
        $_SESSION['full_name'] = $username;
        header("Location: index.php");
        exit();
    } else {
        // User not found, redirect back to login page with error message
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: log_in.php");
        exit();
    }
} else {
    // If form is not submitted, redirect back to login page
    header("Location: log_in.php");
    exit();
}
?>
