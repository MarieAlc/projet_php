<h2>Mon Profil</h2>

<?php
if (isset($_SESSION['message'])) {
    echo '<div class="confirmation-message">' . htmlspecialchars($_SESSION['message']) . '</div>';

    unset($_SESSION['message']);
}
?>

<section>
    <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['mail']) ?></p>
</section>

<h3>Mes Rendez-vous</h3>
<section>
    <?php if (!empty($rendezvousList)): ?>
        <ul>
            <?php foreach ($rendezvousList as $rdv): ?>
                <li>
                    <strong>Date :</strong> <?= htmlspecialchars($rdv->getDate()) ?><br>
                    <strong>Heure :</strong> <?= htmlspecialchars($rdv->getHeure()->format('H:i')) ?><br>
                    <strong>Motif :</strong> <?= htmlspecialchars($rdv->nomService) ?><br>
                </li><br>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun rendez-vous à afficher.</p>
    <?php endif; ?>
</section>

<section>
    <p><a href="index.php?action=modifierprofilutilisateur&id=<?php echo $_SESSION['user']['id']; ?>">Modifier son profil</a></p>
    <p><a href="index.php?action=listerendezvousutilisateur">Modifier ses rendez-vous</a></p>
    <p><a href="index.php?action=deconnexion">Se déconnecter</a></p>
</section>
