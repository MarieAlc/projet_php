<?php
if (isset($_SESSION['message'])) {
    echo '<div class="confirmation-message">' . htmlspecialchars($_SESSION['message']) . '</div>';
    // Vider le message après l'affichage
    unset($_SESSION['message']);
}
?>

<section>
    <h1>Avis des patients</h1>
    
    <?php $avisManager = new AvisManager();
        $noteMoyenne = $avisManager->getMoyenneNote();?>
    <h3 class="moyenneAvis"><strong>Note moyenne : </strong> <?= $noteMoyenne ?>/5</h3>
</section>



<!-- Liste des avis -->
 <section>
     <?php if (!empty($avisList)): ?>
         <?php foreach ($avisList as $avis): ?>
         <div class="avis">
             <p><strong>Nom du patient :</strong> <?php echo htmlspecialchars($avis->getNomPatient()); ?></p>
             <p><strong>Note :</strong> <?php echo htmlspecialchars($avis->getNote()); ?> /5</p>
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
 </section>
<section>

    <button class ="btnAvis">
        <a href="index.php?action=formulaireavis">Ajouter un avis</a>
    </button>
</section>
