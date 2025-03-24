<?php
// Point d'entrée unique
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'loginForm';

switch($controller) {
    case 'auth':
        require_once 'controllers/AuthController.php';
        $obj = new AuthController();
        break;
    case 'user':
        require_once 'controllers/UserController.php';
        $obj = new UserController();
        break;
    case 'dashboard':
        require_once 'controllers/DashboardController.php';
        $obj = new DashboardController();
        break;
    default:
        echo "Contrôleur non trouvé";
        exit;
}

if(method_exists($obj, $action)) {
    $obj->{$action}();
} else {
    echo "Action non trouvée";
}
