<?php
require_once 'Database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    // Récupérer un utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    // Récupérer un utilisateur par id
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Créer un utilisateur
    public function create($username, $email, $password, $role_id, $status = 'active') {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role_id, status) VALUES (:username, :email, :password, :role_id, :status)");
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'password' => $hash,
            'role_id'  => $role_id,
            'status'   => $status
        ]);
    }

    // Mettre à jour un utilisateur (seulement username et email modifiables par l'utilisateur)
    public function update($id, $username, $email) {
        $stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email WHERE id = :id");
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'id'       => $id
        ]);
    }

    // Pour l'administrateur : modification complète d'un utilisateur (y compris rôle et statut)
    public function updateAdmin($id, $username, $email, $role_id, $status) {
        $stmt = $this->pdo->prepare("UPDATE users SET username = :username, email = :email, role_id = :role_id, status = :status WHERE id = :id");
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'role_id'  => $role_id,
            'status'   => $status,
            'id'       => $id
        ]);
    }

    // Supprimer un utilisateur
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Récupérer la liste de tous les utilisateurs
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}
