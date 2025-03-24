<?php
require_once 'Database.php';

class SessionLog
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }


    public function logLogin($user_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO sessions (user_id, login_time) VALUES (:user_id, NOW())");
        $stmt->execute(['user_id' => $user_id]);

        // Récupérer l'ID de la session créée
        $_SESSION['session_id'] = $this->pdo->lastInsertId();
    }


    // Enregistrer une déconnexion
    public function logLogout($session_id)
    {
        $stmt = $this->pdo->prepare("UPDATE sessions SET logout_time = NOW() WHERE id = :id");
        return $stmt->execute(['id' => $session_id]);
    }

    // Récupérer la dernière session de l'utilisateur (celle qui n'a pas encore de logout_time)
    public function getLastSessionByUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sessions WHERE user_id = :user_id ORDER BY login_time DESC LIMIT 1");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetch();
    }

    // Récupérer l'historique des connexions d'un utilisateur
    public function getLogsByUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM sessions WHERE user_id = :user_id ORDER BY login_time DESC");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    // Récupérer tous les logs de connexion
    public function getAllLogs()
    {
        $stmt = $this->pdo->query("SELECT * FROM sessions ORDER BY login_time DESC");
        return $stmt->fetchAll();
    }
}
