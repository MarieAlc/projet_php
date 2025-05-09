<h2 class="section-titre">Modifier mon rendez-vous</h2>

<?php if (!empty($message)): ?>
    <div class="confirmation-message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<h2 class="section-titre">Mes Rendez-vous</h2>


<?php if (!empty($rendezvousList)): ?>
    <table class="table-rendezvous">
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
                        <a class="btn-modifier" href="index.php?action=modifierrendezvousutilisateur&id=<?= $rdv->getId() ?>">Modifier</a>
                        <a class="btn-supprimer" href="index.php?action=supprimerRendezVousUtilisateur&id=<?= $rdv->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="aucunRdv">Aucun rendez-vous trouvé.</p>
<?php endif; ?>
