<?php
session_start(); // Start session
require_once('connection.php');
require_once('article.php'); // Include ArticleManagement class

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Create a new instance of ArticleManagement class
$articleManagement = new ArticleManagement($conn);

// Check if the article ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: dashboard.php"); // Redirect to dashboard if no article ID is provided
    exit;
}

// Get the article ID from the URL
$articleId = $_GET['id'];

// Fetch the article by its ID
$articleDetails = $articleManagement->getArticleById($articleId);

// Check if the article exists
if (!$articleDetails) {
    header("Location: dashboard.php"); // Redirect to dashboard if article does not exist
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];

    // Call updateArticle method to update the article
    $articleManagement->updateArticle($articleId, $title, $content, $image_url, $description);

    // Redirect to the user dashboard or any other page after updating the article
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Article</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
          :root {
            --palestine-green: #006400; /* Dark green */
            --palestine-red: #d81e05; /* Dark red */
            --palestine-white: #ffffff; /* White */
            --palestine-black: #000000; /* Black */
        }
        body {
            background-image: linear-gradient(to bottom right, var(--palestine-green), var(--palestine-red)); /* Linear gradient background */
        }

        .card {
            margin-top: 50px; /* Adjust margin-top as needed */
            background-color: #f8f9fa; /* Light gray background color */
        }

        .card-title {
            color: #343a40; /* Dark text color */
        }

        .card-text {
            color: #6c757d; /* Medium-dark text color */
        }

        /* Add more custom styles as needed */
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty($articleDetails['image_url'])) { ?>
                            <img src="<?php echo $articleDetails['image_url']; ?>" class="img-fluid" alt="Article Image">
                        <?php } ?>

                        <h2 class="card-title"><?php echo $articleDetails['title']; ?></h2>
                        <p class="card-text"><?php echo $articleDetails['content']; ?></p>
                        <p class="card-text"><?php echo $articleDetails['description']; ?></p>
                        <!-- Form for updating the article -->

                     
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
