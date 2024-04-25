<?php
require_once('connection.php');
// Article class
class User {
    public $id;
    public $email;
    public $username;
    public $password;

    public function __construct($id, $email, $username, $password) {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }
}

// User management class
class UserManagement {
    private $conn; // Connection passed by session

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Create a new user
    public function createUser($username, $password, $email) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO user (username_user, password_user, email_user) VALUES (:username, :password, :email)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }

    // Retrieve a user by ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM user WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $user_id, PDO::PARAM_INT); // Bind user_id as integer
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Update a user
    public function updateUser($user_id, $username, $password, $email) {
        $stmt = $this->conn->prepare("UPDATE user SET username_user = ?, password_user = ?, email_user = ? WHERE id_user = ?");
        $stmt->bind_param("sssi", $username, $password, $email, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    // Delete a user
    public function deleteUser($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE id_user = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    }

    // Fetch all users
    public function getAllUsers() {
        $users = array();
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($row['id_user'], $row['email_user'], $row['username_user'], $row['password_user']);
            $users[] = $user;
        }
    
        return $users;
    }

    public function getUserByUsernameAndPassword($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username_user = :username AND password_user = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getArticlesByUserId($user_id) {
        $articles = array();
        $stmt = $this->conn->prepare("SELECT * FROM articles WHERE author_id = ?");
        $stmt->execute([$user_id]);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $articles[] = $row;
        }
    
        return $articles;
    }    
    
}
?>
