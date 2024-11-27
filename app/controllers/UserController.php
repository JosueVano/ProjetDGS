<?php
namespace app\controllers;

use app\models\User;

class UserController {
    
    public function showLoginForm() {
       include __DIR__ . '/../../public/views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $userModel = new User();
    
            $user = $userModel->login($username, $password);
    
            if ($user) {
                // Successful authentication
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: /agence");
                exit();
            } else {
                // Authentication failed
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /ProjetDGS/public/index.php");
        exit();
    }
}