

<h2 style="text-align: center; color: #2c3e50;">Modifier mon rendez-vous</h2>


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

<h2 style="text-align: center; color: #2c3e50;">Mes Rendez-vous</h2>

<?php if (!empty($rendezvousList)): ?>
    <table border="1" style="width: 100%; margin: 20px 0;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Motif</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rendezvousList as $rdv): ?>
                <tr>
                    <td><?= htmlspecialchars($rdv->getDate()) ?></td>
                    <td><?= $rdv->getHeure()->format('H:i') ?></td>
                    <td><?= htmlspecialchars($rdv->getMotifNom()) ?></td>
                    <td><?= htmlspecialchars($rdv->getMailPatient()) ?></td>
                    <td>
                        <a href="index.php?action=modifierrendezvousutilisateur&id=<?= $rdv->getId() ?>">Modifier</a> | 
                        <a href="index.php?action=supprimerRendezVousUtilisateur&id=<?= $rdv->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun rendez-vous trouvé.</p>
<?php endif; ?>