<?php require_once 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
<h2 class="mt-4">Mon Profil</h2>

<!-- Affichage des informations en lecture seule (Card Bootstrap 4) -->
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Mes Informations</h3>
    </div>
    <div class="card-body">
        <p><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($_SESSION['user']['username']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
        <!-- Bouton ouvrant la modale pour modifier les infos -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateProfileModal">
            Modifier mes informations
        </button>
    </div>
</div>

<h3>Historique de mes connexions</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Session</th>
            <th>Date de connexion</th>
            <th>Date de déconnexion</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($logs as $log): ?>
        <tr>
            <td><?= htmlspecialchars($log['id']) ?></td>
            <td><?= htmlspecialchars($log['login_time']) ?></td>
            <td><?= htmlspecialchars($log['logout_time']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

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
                <form method="post" action="index.php?controller=user&action=updateProfile">
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
<?php require_once 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
