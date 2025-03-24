<?php
// Inclusion du fichier Database.php pour accéder à la connexion à la base de données
require_once 'Database.php';

/**
 * Classe User : Gère les opérations CRUD sur les utilisateurs.
 */
class User {
    // Attribut contenant la connexion PDO
    private $pdo;

    /**
     * Constructeur de la classe User.
     * Initialise la connexion à la base de données en récupérant l'instance unique de Database.
     */
    public function __construct() {
        // Récupération de la connexion PDO via le Singleton Database
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * Récupérer un utilisateur par son adresse email.
     * @param string $email L'adresse email de l'utilisateur.
     * @return array|false Retourne un tableau contenant les données de l'utilisateur ou false si non trouvé.
     */
    public function getUserByEmail($email) {
        // Préparation de la requête pour récupérer un utilisateur via son email
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        
        // Exécution de la requête avec l'email en paramètre
        $stmt->execute(['email' => $email]);

        // Retourne l'utilisateur trouvé ou false
        return $stmt->fetch();
    }

    /**
     * Récupérer un utilisateur par son identifiant unique (ID).
     * @param int $id L'identifiant de l'utilisateur.
     * @return array|false Retourne un tableau contenant les données de l'utilisateur ou false si non trouvé.
     */
    public function getUserById($id) {
        // Préparation de la requête pour récupérer un utilisateur via son ID
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        
        // Exécution de la requête avec l'ID en paramètre
        $stmt->execute(['id' => $id]);

        // Retourne l'utilisateur trouvé ou false
        return $stmt->fetch();
    }

    /**
     * Créer un nouvel utilisateur avec un mot de passe sécurisé.
     * @param string $username Nom d'utilisateur.
     * @param string $email Adresse email.
     * @param string $password Mot de passe non chiffré.
     * @param int $role_id Identifiant du rôle de l'utilisateur.
     * @param string $status Statut de l'utilisateur (par défaut : 'active').
     * @return bool Retourne true si l'utilisateur a été créé avec succès, sinon false.
     */
    public function create($username, $email, $password, $role_id, $status = 'active') {
        // Hachage sécurisé du mot de passe avant insertion dans la base de données
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // Préparation de la requête pour insérer un nouvel utilisateur
        $stmt = $this->pdo->prepare("
            INSERT INTO users (username, email, password, role_id, status) 
            VALUES (:username, :email, :password, :role_id, :status)
        ");

        // Exécution de la requête avec les valeurs fournies
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'password' => $hash,  // Mot de passe stocké sous forme chiffrée
            'role_id'  => $role_id,
            'status'   => $status
        ]);
    }

    /**
     * Mettre à jour le nom et l'email d'un utilisateur.
     * @param int $id Identifiant de l'utilisateur.
     * @param string $username Nouveau nom d'utilisateur.
     * @param string $email Nouvelle adresse email.
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     */
    public function update($id, $username, $email) {
        // Préparation de la requête pour modifier un utilisateur
        $stmt = $this->pdo->prepare("
            UPDATE users SET username = :username, email = :email WHERE id = :id
        ");

        // Exécution de la requête avec les nouvelles valeurs
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'id'       => $id
        ]);
    }

    /**
     * Mise à jour complète d'un utilisateur (rôle et statut inclus) par un administrateur.
     * @param int $id Identifiant de l'utilisateur.
     * @param string $username Nouveau nom d'utilisateur.
     * @param string $email Nouvelle adresse email.
     * @param int $role_id Nouveau rôle de l'utilisateur.
     * @param string $status Nouveau statut de l'utilisateur.
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     */
    public function updateAdmin($id, $username, $email, $role_id, $status) {
        // Préparation de la requête pour mettre à jour un utilisateur avec rôle et statut
        $stmt = $this->pdo->prepare("
            UPDATE users SET username = :username, email = :email, role_id = :role_id, status = :status WHERE id = :id
        ");

        // Exécution de la requête avec les nouvelles valeurs
        return $stmt->execute([
            'username' => $username,
            'email'    => $email,
            'role_id'  => $role_id,
            'status'   => $status,
            'id'       => $id
        ]);
    }

    /**
     * Supprimer un utilisateur de la base de données.
     * @param int $id Identifiant de l'utilisateur.
     * @return bool Retourne true si la suppression a réussi, sinon false.
     */
    public function delete($id) {
        // Préparation de la requête pour supprimer un utilisateur
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");

        // Exécution de la requête avec l'ID en paramètre
        return $stmt->execute(['id' => $id]);
    }

    /**
     * Récupérer tous les utilisateurs enregistrés dans la base de données.
     * @return array Liste des utilisateurs sous forme de tableau associatif.
     */
    public function getAll() {
        // Exécution d'une requête pour récupérer tous les utilisateurs
        $stmt = $this->pdo->query("SELECT * FROM users");

        // Retourne tous les utilisateurs sous forme de tableau
        return $stmt->fetchAll();
    }
}
