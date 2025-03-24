<?php
// Inclusion du fichier de configuration contenant les constantes de connexion à la base de données
require_once __DIR__ . '/../config/config.php';

/**
 * Classe Database : Gère la connexion à la base de données avec le pattern Singleton.
 * Cela signifie qu'il n'existera qu'une seule instance de cette classe dans toute l'application.
 */
class Database {
    // Instance unique de la classe (singleton)
    private static $instance = null;
    
    // Objet PDO pour la connexion à la base de données
    private $pdo;

    /**
     * Constructeur privé : Empêche la création d'instances multiples de la classe Database.
     * Initialise la connexion à la base de données avec PDO.
     */
    private function __construct() {
        // Chaîne de connexion DSN pour PDO (spécifie l'hôte, le nom de la base de données et le jeu de caractères)
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

        // Création d'une instance PDO avec les identifiants définis dans le fichier de configuration
        $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $GLOBALS['options']);
    }

    /**
     * Méthode statique permettant d'obtenir l'instance unique de Database.
     * Si l'instance n'existe pas encore, elle est créée.
     * @return Database L'instance unique de la classe Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Méthode permettant d'obtenir la connexion PDO active.
     * @return PDO L'objet PDO connecté à la base de données
     */
    public function getConnection() {
        return $this->pdo;
    }
}
