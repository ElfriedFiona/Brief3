<?php
if (!isset($_SESSION)) {
    session_start();
}

// Si $users ou $logs ne sont pas définis, initialisez-les par défaut
$users = isset($users) ? $users : [];
$logs = isset($logs) ? $logs : [];

// Pour les compteurs en temps réel, on peut effectuer quelques calculs ici.
$totalUsers = count($users);

// Calculer le nombre de connexions de la journée (en se basant sur le champ login_time)
$today = date('Y-m-d');
$todayConnections = 0;
foreach ($logs as $log) {
    if (strpos($log['login_time'], $today) === 0) {
        $todayConnections++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!------ Include the above in your HEAD tag ---------->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/TEST/app/public/assets/css/dashboard.css">
    <title>Dashboard</title>
</head>

<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <!-- Navigation -->
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a href="home.html">
                        <img src="http://localhost/TEST/app/public/assets/images/user.png" alt="logo" class="hidden-xs hidden-sm">
                        <img src="http://localhost/TEST/app/public/assets/images/user.png" alt="logo" class="visible-xs visible-sm circle-logo">
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li class="active" data-target="home-content">
                            <a href="#"><i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Home</span>
                            </a>
                        </li>
                        <li data-target="users-content">
                            <a href="#"><i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Users</span>
                            </a>
                        </li>
                        <li data-target="logs">
                            <a href="#"><i class="fa fa-cog" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Logs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Fin Navigation -->

            <!-- Contenu principal -->
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="http://localhost/TEST/app/public/assets/images/user.png" alt="user">
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="navbar-content">
                                                    <span><?= htmlspecialchars($_SESSION['user']['username']) ?></span>
                                                    <p class="text-muted small">
                                                        <?= htmlspecialchars($_SESSION['user']['email']) ?>
                                                    </p>
                                                    <div class="divider"></div>
                                                    <a data-target="profile" href="#" class="view btn-sm active">View Profile</a>
                                                </div>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="index.php?controller=auth&action=logout">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>

                <!-- Contenu du dashboard -->
                <div class="user-dashboard">
                    <!-- Section Home -->
                    <div id="home-content" class="content-section active">
                        <h1>Welcome <?= htmlspecialchars($_SESSION['user']['username']) ?></h1>
                        <p>This is the home content.</p>
                        <p>Nombre total d'utilisateurs : <strong><?= $totalUsers ?></strong></p>
                        <p>Nombre de connexions aujourd'hui : <strong><?= $todayConnections ?></strong></p>
                    </div>

                    <!-- Section Users -->
                    <div id="users-content" class="content-section">
                        <h1>Users</h1>
                        <!-- Bouton Ajouter qui ouvre le modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_User">Ajouter</button>
                        <br><br>
                        <!-- Tableau complet des utilisateurs -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom d'utilisateur</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $u): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($u['id']) ?></td>
                                        <td><?= htmlspecialchars($u['username']) ?></td>
                                        <td><?= htmlspecialchars($u['email']) ?></td>
                                        <td><?= htmlspecialchars($u['role_id']) ?></td>
                                        <td><?= htmlspecialchars($u['status']) ?></td>
                                        <td>
                                            <button
                                                class="btn btn-sm btn-warning edit-user"
                                                data-id="<?= $u['id'] ?>"
                                                data-username="<?= htmlspecialchars($u['username']) ?>"
                                                data-email="<?= htmlspecialchars($u['email']) ?>"
                                                data-role="<?= $u['role_id'] ?>"
                                                data-status="<?= htmlspecialchars($u['status']) ?>">
                                                Modifier
                                            </button>
                                            <a href="index.php?controller=user&action=delete&id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Section Logs -->
                    <div id="logs" class="content-section">
                        <h1>Consultation des logs de connexion</h1>
                        <!-- Tableau des logs -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Session</th>
                                    <th>ID Utilisateur</th>
                                    <th>Date de connexion</th>
                                    <th>Date de déconnexion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($logs as $log): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($log['id']) ?></td>
                                        <td><?= htmlspecialchars($log['user_id']) ?></td>
                                        <td><?= htmlspecialchars($log['login_time']) ?></td>
                                        <td><?= htmlspecialchars($log['logout_time']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Section Profile -->
                    <div id="profile" class="content-section">
                        <h1>Profile de l'utilisateur (Mon Profil)</h1>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mes Informations</h3>
                            </div>
                            <div class="panel-body">
                                <p><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($_SESSION['user']['username']) ?></p>
                                <p><strong>Email :</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                                <p><strong>Rôle :</strong> <?= htmlspecialchars($_SESSION['user']['role_id']) ?></p>
                                <!-- Bouton Modifier pour permettre la mise à jour des infos -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfileModal">
            Modifier 
        </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin contenu du dashboard -->
            </div>
            <!-- Fin contenu principal -->
        </div>
    </div>

    <!-- Modale pour la mise à jour du profil -->
    <div id="updateProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenu de la modale -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifier mes informations</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="index.php?controller=user&action=updateAdmin">
                    <div class="form-group">
                        <label>Nom d'utilisateur :</label>
                        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['username']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email :</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal d'ajout d'un utilisateur -->
    <div id="add_User" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenu du modal -->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Ajouter un Utilisateur</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php?controller=user&action=create">
                        <div class="form-group">
                            <label>Nom d'utilisateur :</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Mot de passe :</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Rôle :</label>
                            <select name="role_id" class="form-control" required>
                                <!-- Vous pouvez itérer sur un tableau de rôles si disponible -->
                                <option value="1">Administrateur</option>
                                <option value="2">Client</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin modal -->

    <!-- Modal d'édition d'un utilisateur -->
    <div id="edit_User" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenu du modal -->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Modifier l'utilisateur</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="index.php?controller=user&action=edit">
                        <!-- Champ caché pour l'ID de l'utilisateur -->
                        <input type="hidden" name="id" id="edit-user-id">

                        <div class="form-group">
                            <label>Nom d'utilisateur :</label>
                            <input type="text" name="username" id="edit-username" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Rôle :</label>
                            <select name="role_id" id="edit-role" class="form-control" required>
                                
                                <option value="1">Administrateur</option>
                                <option value="2">Client</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Statut :</label>
                            <select name="status" id="edit-status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });
            // Gestion des clics sur la navigation de gauche
            $('.navi li').click(function() {
                $('.navi li').removeClass('active');
                $(this).addClass('active');
                var target = $(this).attr('data-target');
                $('.content-section').removeClass('active');
                $('#' + target).addClass('active');
            });
        });

        $(document).ready(function() {
            $('.view').click(function(e) {
                e.preventDefault();
                $('.content-section').removeClass('active');
                $('#profile').addClass('active');
            });
        });

        $(document).ready(function() {
            // Lorsque le bouton Modifier est cliqué
            $('.edit-user').click(function() {
                // Récupérer les données de l'utilisateur depuis les attributs data-
                var id = $(this).data('id');
                var username = $(this).data('username');
                var email = $(this).data('email');
                var role = $(this).data('role');
                var status = $(this).data('status');

                // Remplir les champs du formulaire de la modale
                $('#edit-user-id').val(id);
                $('#edit-username').val(username);
                $('#edit-email').val(email);
                $('#edit-role').val(role);
                $('#edit-status').val(status);

                // Afficher la modale
                $('#edit_User').modal('show');
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>