<?php
require_once('connection.php');
// Article class
class Article {
    public $id;
    public $title;
    public $content;
    public $description;
    public $image_url;
    public $author_id;
    public $created_at;
    public $updated_at;

    public function __construct($id, $title, $content, $image_url, $author_id, $created_at, $updated_at,$description) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image_url = $image_url;
        $this->author_id = $author_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->description = $description;
    }
}

// Article management class
class ArticleManagement {
    private $conn; // Connection passed by session

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Create a new article
  // Create a new article
public function createArticle($title, $content, $image_url, $description) {
    // Get the author ID from the session
    $author_id = $_SESSION['user_id'];
    
    // Prepare the SQL statement
    $stmt = $this->conn->prepare("INSERT INTO articles (title, content, image_url, description, author_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $content);
    $stmt->bindParam(3, $image_url);
    $stmt->bindParam(4, $description);
    $stmt->bindParam(5, $author_id, PDO::PARAM_INT);
    
    // Execute the statement
    $stmt->execute();
}


    // Retrieve an article by ID
    public function getArticleById($article_id) {
        $sql = "SELECT * FROM articles WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $article_id, PDO::PARAM_INT); // Bind article_id as integer
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
      }

    // Update an article
    public function updateArticle($article_id, $title, $content, $image_url, $description) {
        $sql = "UPDATE articles SET title = :title, content = :content, image_url = :image_url, description = :description WHERE id = :article_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':article_id', $article_id);
        $stmt->execute();
        $stmt->closeCursor(); // Use closeCursor() instead of close()
    }
    
    
    

// Delete an article
public function deleteArticle($article_id) {
    $stmt = $this->conn->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->bindValue(1, $article_id, PDO::PARAM_INT);
    $stmt->execute();
   
}

}

class AllArticleManagement {
    private $conn; // Connection passed by session

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fetch all articles
    public function getAllArticles() {
        $articles = array();
        $stmt = $this->conn->prepare("SELECT * FROM articles");
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article($row['id'], $row['title'], $row['content'], $row['image_url'], $row['author_id'], $row['created_at'], $row['updated_at'], $row['description']);
            $articles[] = $article;
        }
    
        return $articles;
    }
}


?>
