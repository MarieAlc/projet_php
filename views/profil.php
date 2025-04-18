<h2>Mon Profil</h2>
<?php if (!empty($_SESSION['message'])): ?>
    <div style="color: green;">
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if (isset($user)): ?>
    <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['mail']) ?></p>
    <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['telephone']) ?></p>
<?php else: ?>
    <p>Utilisateur non trouvé.</p>
<?php endif; ?>

<a href="index.php?action=deconnexion">Se déconnecter</a>

