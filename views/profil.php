<h2>Mon Profil</h2>

<p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
<p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
<p><strong>Email :</strong> <?= htmlspecialchars($user['mail']) ?></p>

<h3>Mes Rendez-vous</h3>
<?php if (!empty($rendezvousList)): ?>
    <ul>
        <?php foreach ($rendezvousList as $rdv): ?>
            <li>
                <strong>Date :</strong> <?= htmlspecialchars($rdv->getDate()) ?><br>
                <strong>Heure :</strong> <?= htmlspecialchars($rdv->getHeure()->format('H:i')) ?><br>
                <strong>Motif :</strong> <?= htmlspecialchars($rdv->nomService) ?><br>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun rendez-vous à afficher.</p>
<?php endif; ?>