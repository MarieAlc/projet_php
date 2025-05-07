<?php if (!empty($_SESSION['message'])): ?>
    <div class=' confirmation-message'><?= htmlspecialchars($_SESSION['message']) ?></div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<h2>Liste des rendez-vous non confirmés</h2>
<section class='listeRdv'>
    <table class="tableRdv">
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Motif</th>               
                <th>Mail</th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rendezvousnonConfirmes as $rdv): ?>
                <tr class='rdvAdmin'>
                    <td><?= htmlspecialchars($rdv->getDate()) ?></td>
                    <td><?= htmlspecialchars($rdv->getHeure()->format('H:i')) ?></td>
                    <td><?= htmlspecialchars($rdv->getMotifNom()) ?></td>              
                    <td><?= htmlspecialchars($rdv->getMailPatient()) ?></td>
                

                    <td class ='modifRdv'><a href="index.php?action=modifierrendezvous&id=<?= $rdv->getId() ?>">Modifier</a></td>
                    <td>
                        <form action="index.php?action=supprimerRendezVous" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');" >
                            <input type="hidden" name="id" value="<?= $rdv->getId() ?>">
                            <button class ='suppRdv' type="submit">🗑 Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form action="index.php?action=validerrendezvous&id=<?= $rdv->getId() ?>" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir confirmer ce rendez-vous ?');">
                            <button class='validerRdv' type="submit">✔ Valider</button>
                        </form>
                    </td>
                

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<h2>Liste des rendez-vous confirmés</h2>
<section>
    <table class="tableRdv">
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Motif</th>
                              
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
</section>
