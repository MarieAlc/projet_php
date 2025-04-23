<h2>Confirmation de votre rendez-vous</h2>

<?php if ($confirmation): ?>
    <p>Merci ! Votre rendez-vous a bien été pris.</p>
    <ul>
        <li><strong>Date :</strong> <?= htmlspecialchars($confirmation['date']) ?></li>
        <li><strong>Heure :</strong> <?= htmlspecialchars($confirmation['heure']) ?></li>
        <li><strong>Motif :</strong> <?= htmlspecialchars($confirmation['motif_nom']) ?></li>
    </ul>
<?php else: ?>
    <p>Aucun rendez-vous n’a été enregistré.</p>
<?php endif; ?>