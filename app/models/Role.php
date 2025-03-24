<?php
// Inclusion du fichier Database.php qui contient la classe de connexion à la base de données
require_once 'Database.php';

/**
 * Classe Role : Gère l'accès aux rôles stockés en base de données.
 */
class Role {
    // Attribut contenant la connexion PDO
    private $pdo;

    /**
     * Constructeur de la classe Role.
     * Initialise la connexion à la base de données en récupérant l'instance unique de Database.
     */
    public function __construct() {
        // Récupération de la connexion PDO à partir du Singleton Database
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * Récupère un rôle spécifique par son ID.
     * @param int $id L'identifiant du rôle à récupérer.
     * @return array|false Retourne un tableau contenant les informations du rôle ou false si non trouvé.
     */
    public function getRoleById($id) {
        // Préparation de la requête SQL avec un paramètre sécurisé (:id) pour éviter les injections SQL
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE id = :id");

        // Exécution de la requête en passant le paramètre sécurisé
        $stmt->execute(['id' => $id]);

        // Récupération et retour du rôle trouvé sous forme de tableau associatif
        return $stmt->fetch();
    }

    /**
     * Récupère tous les rôles disponibles en base de données.
     * @return array Liste de tous les rôles sous forme de tableaux associatifs.
     */
    public function getAllRoles() {
        // Exécution d'une requête SQL pour récupérer tous les rôles de la table "roles"
        $stmt = $this->pdo->query("SELECT * FROM roles");

        // Retourne tous les résultats sous forme de tableau associatif
        return $stmt->fetchAll();
    }
}
