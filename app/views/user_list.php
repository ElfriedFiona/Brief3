<?php require_once 'header.php'; ?>
<h2>Liste des utilisateurs</h2>
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
    <?php foreach($users as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u['id']) ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['role_id']) ?></td>
            <td><?= htmlspecialchars($u['status']) ?></td>
            <td>
                <a href="index.php?controller=user&action=edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                <a href="index.php?controller=user&action=delete&id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require_once 'footer.php'; ?>
