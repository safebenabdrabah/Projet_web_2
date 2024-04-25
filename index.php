<?php
require_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for background image -->
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/10010406/pexels-photo-10010406.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .article-card {
            background-color: rgba(255, 255, 255, 0.8);
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="my-5 text-center text-white">Welcome to Our Blog!</h1>

    <div class="row">
        <?php
        // Include necessary files and initialize database connection
        require_once('connection.php');
        require_once('article.php');

        // Create an instance of AllArticleManagement class
        $allArticleManagement = new AllArticleManagement($conn);

        // Fetch all articles
        $articles = $allArticleManagement->getAllArticles();

        // Loop through articles and display them
        foreach ($articles as $article) {
        ?>
        <div class="col-md-4">
            <div class="article-card">
                <img src="<?php echo $article->image_url; ?>" class="img-fluid mb-3" alt="Article Image">
                <h3><?php echo $article->title; ?></h3>
                <p><?php echo $article->description; ?></p>
                <a href="publicarticle.php?id=<?php echo $article->id; ?>" class="btn btn-primary">View Article</a>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
