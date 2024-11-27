<?php
namespace app\models;

use config\Database;

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();  
    
    
        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            // Verify password using password_verify()
            //passwor_verify !!!!
            if ($password===$row['password']) {
                return $row; // Authentication successful
            } else {
                // Handle authentication failure
                error_log("Incorrect password for user: " . $username);
            }
        } else {
            // Handle user not found
            error_log("User not found: " . $username);
        }
    
        return null; // Authentication failed
    }

    public function current()
    {
        session_start();

        $id = $_SESSION['user_id'];

        $query = "SELECT * FROM `users`  WHERE `id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        $stmt->execute(); 

        return $stmt->fetch();

    }
}