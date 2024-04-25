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
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];

    // Create a new instance of ArticleManagement class
    $articleManagement = new ArticleManagement($conn);

    // Call createArticle method to add the article
    $articleManagement->createArticle($title, $content, $image_url, $description);

    // Redirect to the user dashboard or any other page after adding the article
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Add Article</h2>
        <form action="add_article.php" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" class="form-control" id="image_url" name="image_url">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Article</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional, if you need Bootstrap JavaScript components) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
