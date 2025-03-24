<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Session.php';

class AuthController
{
    private $userModel;
    private $sessionModel;

    public function __construct()
    {
        session_start();
        $this->userModel = new User();
        $this->sessionModel = new SessionLog();
    }

    // Affiche le formulaire de connexion
    public function loginForm()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    // Traiter la connexion
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            if (!$email || !$password) {
                $error = "Veuillez remplir correctement le formulaire.";
                require_once __DIR__ . '/../views/login.php';
                exit;
            }

            $user = $this->userModel->getUserByEmail($email);

            if ($user) {
                if ($user['status'] !== 'active') {
                    $error = "Votre compte est inactif. Veuillez contacter l'administrateur.";
                    require_once __DIR__ . '/../views/login.php';
                    exit;
                }
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    // Enregistrer la connexion dans le log
                    $this->sessionModel->logLogin($user['id']);
                    // Rediriger selon le rôle
                    if ($user['role_id'] == 1) {
                        header("Location: index.php?controller=dashboard&action=index");
                    } else {
                        header("Location: index.php?controller=user&action=profile");
                    }
                    exit;
                }
            }
            $error = "Email ou mot de passe invalide.";
            require_once __DIR__ . '/../views/login.php';
        }
    }

    // Déconnexion
    public function logout()
    {
        session_start();

        if (isset($_SESSION['user']['id'])) {
            $user_id = $_SESSION['user']['id'];
            $lastSession = $this->sessionModel->getLastSessionByUser($user_id);

            if ($lastSession) {
                $this->sessionModel->logLogout($lastSession['id']);
            }
        }

        session_destroy();
        header("Location: index.php?controller=auth&action=loginForm");
        exit;
    }
}
