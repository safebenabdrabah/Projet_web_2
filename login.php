<?php
require_once('connection.php');
require_once('User.php'); // Assuming you've saved the classes in a file named UserManagement.php

// Start session
session_start();

// Check if the user is already logged in, redirect to dashboard if so
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Create a new instance of UserManagement class
    $userManagement = new UserManagement($conn);

    // Check if the user exists with the provided credentials
    $user = $userManagement->getUserByUsernameAndPassword($username, $password);
    
    if ($user) {
        // User exists, start a session and store user information
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['username'] = $user['username_user'];
        $_SESSION['email'] = $user['email_user'];

        // Redirect to dashboard or some other page
        header("Location: dashboard.php");
        exit;
    } else {
        // Invalid credentials, display an error message
        $error_message = "Invalid username or password.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
            :root {
            --palestine-green: #006400; /* Dark green */
            --palestine-red: #d81e05; /* Dark red */
            --palestine-white: #ffffff; /* White */
            --palestine-black: #000000; /* Black */
        }
        body {
            background-image: linear-gradient(to bottom right, var(--palestine-green), var(--palestine-red));
            color: var(--palestine-white);
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            margin-top: 50px;
        }

        .form-control {
            border-color: var(--palestine-black);
        }

        .btn-primary {
            background-color: var(--palestine-black);
            border-color: var(--palestine-black);
        }

        .btn-primary:hover {
            background-color: var(--palestine-white);
            color: var(--palestine-black);
            border-color: var(--palestine-black);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Login</h2>
                <?php if(isset($error_message)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php } ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <h5 class="mt-3">If you don't have an account, sign up <a href="signup.html">here</a>.</h5>
            </div>
        </div>
    </div>
</body>
</html>
