<?php
namespace App\controllers;

use config\Database;

use app\models\User;
use app\Lib\View;

class LoginController
{

    public function login()
    {

        // include __DIR__ . '/../../public/views/login.php';

        $agence = "SOLIRAF";

        return View::make('login', [
            'agence'    =>$agence,
            'adresse'   =>'ANJOMA',
        ]);

    }

    public function store() {

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
                header("Location: /");
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
        header("Location: /login");
        exit();
    }

}