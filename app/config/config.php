<?php
// Configuration de la connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestionclient');
define('DB_USER', 'root');
define('DB_PASS', '');

// Pour activer le mode erreurs PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
