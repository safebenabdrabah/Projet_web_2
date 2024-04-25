<?php
// Include connection.php and the class file containing ArticleManagement class
require_once('connection.php');
require_once('article.php'); // Assuming your class file is named article_management_class.php

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if article ID is provided in the POST request
    if (isset($_POST['article_id'])) {
        // Retrieve the article ID from the POST request
        $articleId = $_POST['article_id'];

        // Instantiate ArticleManagement class with the database connection
        $articleManagement = new ArticleManagement($conn);

        // Call deleteArticle method to delete the article
        $articleManagement->deleteArticle($articleId);

        // Redirect to some page after deletion or show a success message
        header("Location: dashboard.php");
        exit();
    } else {
        // Redirect to some page or show an error message if article ID is not provided
        header("Location: dashboard.php");
        exit();
    }
} else {
    // Redirect to some page or show an error message if the form is not submitted via POST method
    header("Location: dashboard.php");
    exit();
}
?>
