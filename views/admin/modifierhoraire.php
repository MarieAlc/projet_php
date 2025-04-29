<h2>Modifier les horaires d'ouverture</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div style="background-color: #d4edda; padding: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<form method="post" action="index.php?action=modifierhoraire">
    <table>
        <tr>
            <th>Jour</th>
            <th>Ouverture</th>
            <th>Fermeture</th>
        </tr>
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
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">Aucun horaire disponible.</td></tr>
        <?php endif; ?>
    </table>
    <input type="submit" name="submit" value="Modifier les horaires">
</form>