<h2 style="text-align: center; color: #2c3e50;">Mon Profil</h2>

<div style="display: flex; justify-content: space-between; align-items: center; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
    <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
    <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
    <p><strong>Email :</strong> <?= htmlspecialchars($user['mail']) ?></p>
</div>

<h3 style="text-align: center;color:rgb(38, 73, 110);">Mes Rendez-vous</h3>
<div style="display: flex; justify-content: space-between; align-items: center; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">

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
</div>
<div style = " display: flex; justify-content: space-between; align-items: center; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
    <p> <a href="index.php?action=modifierprofilutilisateur">Modifier son profil</a></p>
    <p><a href="index.php?action=listerendezvousutilisateur">Modifier ses rendez-vous</a></p>
    <p><a href="index.php?action=deconnexion">Se déconnecter</a></p>
</div>