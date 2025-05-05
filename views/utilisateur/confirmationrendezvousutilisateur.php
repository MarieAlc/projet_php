<h2 class="confirmation-titre">Confirmation de votre rendez-vous</h2>

<?php if ($confirmation): ?>
    <p class="confirmation-message">Merci ! Votre rendez-vous a bien été pris.</p>
    <ul class="confirmation-details">
        <li><strong>Date :</strong> <?= htmlspecialchars($confirmation['date']) ?></li>
        <li><strong>Heure :</strong> <?= htmlspecialchars($confirmation['heure']) ?></li>
        <li><strong>Motif :</strong> <?= htmlspecialchars($confirmation['motif_nom']) ?></li>
    </ul>
<?php else: ?>
    <p class="confirmation-erreur">Aucun rendez-vous n’a été enregistré.</p>
<?php endif; ?>
