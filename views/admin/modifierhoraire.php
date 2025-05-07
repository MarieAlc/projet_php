<h2>Modifier les horaires d'ouverture</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div class='confirmation-message'>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>
<section class='modifHoraire'>

    <form method="post" action="index.php?action=modifierhoraire">
        <table>
            <thead>
                <tr>
                    <th>Jour</th>
                    <th>Ouverture</th>
                    <th>Fermeture</th>
                    <th>Overt / Fermer</th>
                </tr>

            </thead>
            <?php if (!empty($horaires)): ?>
                <?php foreach ($horaires as $horaire): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($horaire->getJour()); ?></td>
                        <td>
                            <input type="time" name="ouverture[<?php echo $horaire->getId(); ?>]" value="<?php echo $horaire->getHeure_debut()->format('H:i'); ?>">
                        </td>
                        <td>
                            <input type="time" name="fermeture[<?php echo $horaire->getId(); ?>]" value="<?php echo $horaire->getHeure_fin()->format('H:i'); ?>">
                        </td>
                        <td class="checkbox">
                        <input type="checkbox" name="ferme[<?php echo $horaire->getId(); ?>]" id="ferme_<?php echo $horaire->getId(); ?>" <?php echo !$horaire->getOuvert() ? 'checked' : ''; ?>>
                        <label for="ferme_<?php echo $horaire->getId(); ?>">Fermé</label>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">Aucun horaire disponible.</td></tr>
            <?php endif; ?>
        </table>
        <input type="submit" name="submit" value="Modifier les horaires">
    </form>
</section>