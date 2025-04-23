<h2>Liste des utilisateurs</h2>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul style="color: red;">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?= htmlspecialchars($utilisateur->getNom()) ?></td>
                <td><?= htmlspecialchars($utilisateur->getPrenom()) ?></td>
                <td><?= htmlspecialchars($utilisateur->getMail()) ?></td>
                <td><?= $utilisateur->getIsAdmin() == 1 ? 'Administrateur' : 'Utilisateur' ?></td>
                <td>
                    <?php if ($utilisateur->getIsAdmin() == 0): ?>
                        <form action="index.php?action=modifieradmin" method="POST">
                            <input type="hidden" name="userId" value="<?= $utilisateur->getId() ?>">
                            <input type="hidden" name="newRole" value="1"> 
                            <input type="submit" value="Promouvoir à administrateur">
                        </form>
                    <?php else: ?>
                        <form action="index.php?action=modifieradmin" method="POST">
                            <input type="hidden" name="userId" value="<?= $utilisateur->getId() ?>">
                            <input type="hidden" name="newRole" value="0">
                            <input type="submit" value="Démouvoir à utilisateur">
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>