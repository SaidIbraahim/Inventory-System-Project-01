<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Signin Form</title>
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000000; /* Background color */
        }
        .form-signin {
            background-color: #ffffff; /* Form background color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Form box shadow */
        }
    </style>
</head>
<body class="text-center">
<?php 
    session_start();
    // Check if the user is already logged in
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        include 'Navbar.php'; // Include the navbar if logged in
        header("Location: index.php"); // Redirect to home if already logged in
        exit();
    }
?> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="form-signin" action="login_process.php" method="post"> <!-- Add action attribute to form -->
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" id="inputUsername" name="full_name" class="form-control mb-2" placeholder="Username" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control mb-2" placeholder="Password" required>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <p class="mt-5 mb-3 text-muted">© EAU Projects</p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
