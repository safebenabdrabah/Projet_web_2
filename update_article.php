<?php
session_start(); // Start session
require_once('connection.php');
require_once('article.php'); // Include ArticleManagement class

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $article_id = $_POST['article_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];

    // Create a new instance of ArticleManagement class
    $articleManagement = new ArticleManagement($conn);

    // Call updateArticle method to update the article
    $articleManagement->updateArticle($article_id, $title, $content, $image_url, $description);

    // Redirect to the user dashboard or any other page after updating the article
    header("Location: dashboard.php");
    exit;
}

// If article ID is not provided, redirect to dashboard
if (!isset($_POST['article_id'])) {
    header("Location: dashboard.php");
    exit;
}

// Fetch the article details based on the provided article ID
// Fetch the article details based on the provided article ID
$article_id = $_POST['article_id'];
$articleManagement = new ArticleManagement($conn);
$articleDetails = $articleManagement->getArticleById($article_id);

// If article details are not found, redirect to dashboard
if (!$articleDetails) {
    header("Location: dashboard.php");
    exit;
}

// Populate form fields with current article information
$title = $articleDetails['title'];
$content = $articleDetails['content'];
$image_url = $articleDetails['image_url'];
$description = $articleDetails['description'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Article</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Update Article</h2>
        <form action="update_article.php" method="post">
            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $content; ?></textarea>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $image_url; ?>">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $description; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Article</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional, if you need Bootstrap JavaScript components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
