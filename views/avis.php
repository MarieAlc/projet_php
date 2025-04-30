<?php
if (isset($_SESSION['message'])) {
    echo '<div class="success-message">' . htmlspecialchars($_SESSION['message']) . '</div>';
    // Vider le message après l'affichage
    unset($_SESSION['message']);
}
?>

<h1>Avis des patients</h1>



<!-- Liste des avis -->
<?php if (!empty($avisList)): ?>
    <?php foreach ($avisList as $avis): ?>
    <div class="avis">
        <p><strong>Nom du patient :</strong> <?php echo htmlspecialchars($avis->getNomPatient()); ?></p>
        <p><strong>Note :</strong> <?php echo htmlspecialchars($avis->getNote()); ?></p>
        <p><strong>Commentaire :</strong> <?php echo nl2br(htmlspecialchars($avis->getCommentaire())); ?></p>
        <p><strong>Date :</strong> <?php echo htmlspecialchars($avis->getDateAvis()); ?></p>
        <?php if ($avis->getPhoto()): ?>
            <p><img src="<?php echo htmlspecialchars($avis->getPhoto()); ?>" alt="Photo"></p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
    
<?php else: ?>
    <p>Aucun avis n'a été laissé pour le moment.</p>
<?php endif; ?>


<p><a href="index.php?action=formulaireavis">Ajouter un avis</a></p>