<?php
// Check if the user is logged in
$user_name = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
           :root {
            --palestine-green: #006400; /* Dark green */
            --palestine-red: #d81e05; /* Dark red */
            --palestine-white: #ffffff; /* White */
            --palestine-black: #000000; /* Black */
        }
        .navbar {
            background-color: var(--palestine-black); /* Black */
            color: var(--palestine-white); /* White */
        }

        .navbar-brand,
        .navbar-nav .nav-link,
        .navbar-text {
            color: var(--palestine-white) !important; /* White */
        }

        .navbar-text a {
            color: var(--palestine-white) !important; /* White */
        }

        .navbar-toggler-icon {
            background-color: var(--palestine-white); /* White */
        }

        .navbar-brand img {
            width: 30px; /* Set width of the image */
            margin-right: 10px; /* Added margin to separate image from text */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="palestineflag.jpg" alt="Palestine Flag"> <!-- Added image -->
        Palestine Blog
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Homepage</a>
            </li>
            <?php if ($user_name) { ?>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <?php } ?>
        </ul>
        <?php if ($user_name) { ?>
            <span class="navbar-text">
                Welcome, <?php echo $user_name; ?>! <a href="logout.php" style="color: white;">Logout</a>
            </span>
        <?php } else { ?>
            <span class="navbar-text">
                Welcome, Se Connecter! <a href="login.php" style="color: white;">Login</a>
            </span>
        <?php } ?>
    </div>
</nav>

</body>
</html>
