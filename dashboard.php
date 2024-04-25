<?php
session_start(); // Start session
require_once('connection.php');
require_once('user.php');
require_once('navbar.php'); // Include UserManagement class

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Create a new instance of UserManagement class
$userManagement = new UserManagement($conn);

// Get details of the currently logged-in user
$userId = $_SESSION['user_id'];
$user = $userManagement->getUserById($userId);

// Fetch articles associated with the user
$articles = $userManagement->getArticlesByUserId($userId);
?>

<!DOCTYPE html>
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Title -->
    <title>User Dashboard</title>

    <!-- Custom CSS -->
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
        }

        .container {
            padding-top: 50px;
        }

        .card {
            background-color: var(--palestine-white);
            border: 1px solid var(--palestine-black);
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-title {
            color: var(--palestine-black); /* Black */
        }

        .btn-success {
            background-color: var(--palestine-black);
            border-color: var(--palestine-black);
        }

        .btn-success:hover {
            background-color: var(--palestine-white);
            color: var(--palestine-black);
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

        .btn-danger {
            background-color: var(--palestine-red);
            border-color: var(--palestine-red);
        }

        .btn-danger:hover {
            background-color: var(--palestine-white);
            color: var(--palestine-red);
            border-color: var(--palestine-red);
        }

        .details {
            color: var(--palestine-black); /* Black */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-5">
                    <h2 class="text-center mb-4">Welcome, <?php echo $user['username_user']; ?>!</h2>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Your Details:</h3>
                            <p class="details"><strong>ID:</strong> <?php echo $user['id_user']; ?></p>
                            <p class="details"><strong>Username:</strong> <?php echo $user['username_user']; ?></p>
                            <p class="details"><strong>Email:</strong> <?php echo $user['email_user']; ?></p>
                            <!-- Add more fields as needed -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Your Articles:</h3>
                            <ul class="list-group">
                                <?php if (!empty($articles)) { ?>
                                    <!-- Loop through articles and display them -->
                                    <?php foreach ($articles as $article) { ?>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $article['title']; ?></h5>
                                                <a href="view_article.php?id=<?php echo $article['id']; ?>" class="btn btn-primary">View Article</a>
                                                <!-- Add delete button with form -->
                                                <form action="delete_article.php" method="post" class="d-inline">
                                                    <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <p>No articles found.</p>
                                <?php } ?>
                                <!-- Add Article button -->
                                <form action="addarticle.html" method="post">
                                    <button type="submit" class="btn btn-success">Add Article</button>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional, if you need Bootstrap JavaScript components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
