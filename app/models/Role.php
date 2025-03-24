<?php
require_once 'Database.php';

class Role {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getRoleById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getAllRoles() {
        $stmt = $this->pdo->query("SELECT * FROM roles");
        return $stmt->fetchAll();
    }
}
