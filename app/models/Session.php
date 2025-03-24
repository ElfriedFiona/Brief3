<?php
// Inclusion du fichier Database.php pour accéder à la connexion à la base de données
require_once 'Database.php';

/**
 * Classe SessionLog : Gère l'enregistrement des sessions de connexion des utilisateurs.
 */
class SessionLog
{
    // Attribut contenant la connexion PDO
    private $pdo;

    /**
     * Constructeur de la classe SessionLog.
     * Initialise la connexion à la base de données en récupérant l'instance unique de Database.
     */
    public function __construct()
    {
        // Récupération de la connexion PDO via le Singleton Database
        $this->pdo = Database::getInstance()->getConnection();
    }

    /**
     * Enregistre une nouvelle session de connexion pour un utilisateur.
     * @param int $user_id L'identifiant de l'utilisateur.
     */
    public function logLogin($user_id)
    {
        // Préparation de la requête d'insertion pour enregistrer l'heure de connexion (NOW())
        $stmt = $this->pdo->prepare("INSERT INTO sessions (user_id, login_time) VALUES (:user_id, NOW())");
        
        // Exécution de la requête avec les paramètres sécurisés
        $stmt->execute(['user_id' => $user_id]);

        // Récupération et stockage dans la session PHP de l'ID de la session nouvellement créée
        $_SESSION['session_id'] = $this->pdo->lastInsertId();
    }

    /**
     * Enregistre la déconnexion d'un utilisateur en mettant à jour l'heure de déconnexion.
     * @param int $session_id L'identifiant de la session de l'utilisateur.
     * @return bool Retourne true si la mise à jour a réussi, sinon false.
     */
    public function logLogout($session_id)
    {
        // Préparation de la requête pour mettre à jour l'heure de déconnexion (NOW())
        $stmt = $this->pdo->prepare("UPDATE sessions SET logout_time = NOW() WHERE id = :id");
        
        // Exécution de la requête et retour du statut de l'exécution
        return $stmt->execute(['id' => $session_id]);
    }

    /**
     * Récupère la dernière session active (sans logout_time) d'un utilisateur.
     * @param int $user_id L'identifiant de l'utilisateur.
     * @return array|false Retourne un tableau contenant la session ou false si aucune session active n'existe.
     */
    public function getLastSessionByUser($user_id)
    {
        // Requête pour récupérer la dernière session de l'utilisateur en triant par date décroissante
        $stmt = $this->pdo->prepare("SELECT * FROM sessions WHERE user_id = :user_id ORDER BY login_time DESC LIMIT 1");

        // Exécution de la requête
        $stmt->execute(['user_id' => $user_id]);

        // Retourne la dernière session trouvée
        return $stmt->fetch();
    }

    /**
     * Récupère tout l'historique des connexions d'un utilisateur.
     * @param int $user_id L'identifiant de l'utilisateur.
     * @return array Liste des sessions de l'utilisateur sous forme de tableau associatif.
     */
    public function getLogsByUser($user_id)
    {
        // Requête pour récupérer toutes les sessions d'un utilisateur, triées par date décroissante
        $stmt = $this->pdo->prepare("SELECT * FROM sessions WHERE user_id = :user_id ORDER BY login_time DESC");

        // Exécution de la requête
        $stmt->execute(['user_id' => $user_id]);

        // Retourne toutes les sessions de l'utilisateur
        return $stmt->fetchAll();
    }

    /**
     * Récupère l'historique complet de toutes les connexions enregistrées dans la base de données.
     * @return array Liste de toutes les sessions sous forme de tableau associatif.
     */
    public function getAllLogs()
    {
        // Exécution de la requête pour récupérer toutes les sessions enregistrées
        $stmt = $this->pdo->query("SELECT * FROM sessions ORDER BY login_time DESC");

        // Retourne toutes les sessions
        return $stmt->fetchAll();
    }
}
