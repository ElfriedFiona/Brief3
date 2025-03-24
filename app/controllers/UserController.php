<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Role.php';
require_once __DIR__ . '/../models/Session.php';

class UserController {
    private $userModel;
    private $roleModel;
    private $sessionModel;

    public function __construct() {
        session_start();
        $this->userModel = new User();
        $this->roleModel = new Role();
        $this->sessionModel = new SessionLog();
        $this->checkAuthentication();
    }

    private function checkAuthentication() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=loginForm");
            exit;
        }
    }

    // Afficher le profil du client
    public function profile() {
        $user = $_SESSION['user'];
        // Récupérer l'historique des connexions
        $logs = $this->sessionModel->getLogsByUser($user['id']);
        require_once __DIR__ . '/../views/profile.php';
    }

    // Pour l'administrateur : afficher la liste de tous les utilisateurs (intégrée dans dashboard)
    public function list() {
        if ($_SESSION['user']['role_id'] != 1) {
            header("Location: index.php");
            exit;
        }
        $users = $this->userModel->getAll();
        $roles = $this->roleModel->getAllRoles();
        require_once __DIR__ . '/../views/dashboard.php';
    }

    // Création d'un utilisateur depuis le dashboard
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $role_id = filter_input(INPUT_POST, 'role_id', FILTER_VALIDATE_INT);
            if ($this->userModel->create($username, $email, $password, $role_id)) {
                echo "<script type=\"text/javascript\">alert('compte créé')</script>";
                header("Location: index.php?controller=dashboard&action=index");
                exit;
            }
        }
        // En dehors d'une requête POST, rediriger vers le dashboard
        header("Location: index.php?controller=dashboard&action=index");
    }

    public function edit() {
        if ($_SESSION['user']['role_id'] != 1) {
            header("Location: index.php");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $role_id = filter_input(INPUT_POST, 'role_id', FILTER_VALIDATE_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $this->userModel->updateAdmin($id, $username, $email, $role_id, $status);
            echo "<script type=\"text/javascript\">alert('compte modifié avec succes')</script>";
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        }
        // En GET, on ne fait rien puisque le formulaire s'affiche en modal dans le dashboard
        header("Location: index.php?controller=dashboard&action=index");
    }

    public function updateProfile() {
        // Vérifier que la requête est bien en POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filtrer et récupérer les valeurs envoyées
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            
            // On suppose que la méthode update() dans le modèle User met à jour username et email pour l'utilisateur
            $userId = $_SESSION['user']['id'];
            $this->userModel->update($userId, $username, $email);
            
            // Mettre à jour les données dans la session
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;
            
            echo "<script type=\"text/javascript\">alert('Vos informations personnelles ont été mis à jour avec succes')</script>";
            // Rediriger vers le profil ou une autre page
            header("Location: index.php?controller=user&action=profile");
            exit;
        } else {
            // Si la méthode n'est pas POST, rediriger vers le profil
            header("Location: index.php?controller=user&action=profile");
            exit;
        }
    }

    public function updateAdmin() {
        // Vérifier que la requête est bien en POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Filtrer et récupérer les valeurs envoyées
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            
            // On suppose que la méthode update() dans le modèle User met à jour username et email pour l'utilisateur
            $userId = $_SESSION['user']['id'];
            $this->userModel->update($userId, $username, $email);
            
            // Mettre à jour les données dans la session
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;
            
            echo 'ok';
            // Rediriger vers le profil ou une autre page
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        } else {
            // Si la méthode n'est pas POST, rediriger vers le profil
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        }
    }
    
    
    // Suppression d'un utilisateur (admin)
    public function delete() {
        if ($_SESSION['user']['role_id'] != 1) {
            header("Location: index.php");
            exit;
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $this->userModel->delete($id);
        }
        header("Location: index.php?controller=dashboard&action=index");
    }
}
