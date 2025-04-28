<?php if (!empty($_SESSION['message'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_SESSION['message']) ?></p>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<h2>Liste des rendez-vous non confirmés</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Motif</th>
            <th>Client</th>
            <th>Mail</th> 
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rendezvousnonConfirmes as $rdv): ?>
            <tr>
                <td><?= htmlspecialchars($rdv->getDate()) ?></td>
                <td><?= htmlspecialchars($rdv->getHeure()->format('H:i')) ?></td>
                <td><?= htmlspecialchars($rdv->getMotifNom()) ?></td>
                <td><?= htmlspecialchars($rdv->getIdClient()) ?></td>
                <td><?= htmlspecialchars($rdv->getMailPatient()) ?></td>
                <td><a href="index.php?action=modifierrendezvous&id=<?= $rdv->getId() ?>">Modifier</a></td>
                <td>
                    <form action="index.php?action=supprimerRendezVous" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $rdv->getId() ?>">
                        <button type="submit" style="background-color: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer;">🗑 Supprimer</button>
                    </form>
                </td>
                <td>
                    <form action="index.php?action=validerrendezvous&id=<?= $rdv->getId() ?>" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir confirmer ce rendez-vous ?');" style="display:inline;">
                        <button type="submit" style="background-color: #2ecc71; color: white; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer;">✔ Valider</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2>Liste des rendez-vous confirmés</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Motif</th>
            <th>Client</th>
            <th>Mail</th> 
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rendezvousconfirmes as $rdv): ?>
            <tr>
                <td><?= htmlspecialchars($rdv->getDate()) ?></td>
                <td><?= htmlspecialchars($rdv->getHeure()->format('H:i')) ?></td>
                <td><?= htmlspecialchars($rdv->getMotifNom()) ?></td>
                <td><?= htmlspecialchars($rdv->getIdClient()) ?></td>
                <td><?= htmlspecialchars($rdv->getMailPatient()) ?></td>
                <td>
                    <form action="index.php?action=supprimerRendezVous" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $rdv->getId() ?>">
                        <button type="submit" style="background-color: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer;">🗑 Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
