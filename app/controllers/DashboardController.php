<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Session.php';

class DashboardController {
    private $userModel;
    private $sessionModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 1) {
            header("Location: index.php?controller=auth&action=loginForm");
            exit;
        }
        $this->userModel = new User();
        $this->sessionModel = new SessionLog();
    }

    public function index() {
        $users = $this->userModel->getAll();
        // Vous pouvez ajouter d'autres statistiques et logs ici
        // Récupérer tous les logs
    $logs = $this->sessionModel->getAllLogs();
        require_once __DIR__ . '/../views/dashboard.php';
    }
}
