<h2>Espace Administrateur</h2>
<?php 

if (!empty($_SESSION['message'])): ?>
    <div class='confirmation-message'>
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>



    <section class='infoAdmin'>
        <?php if (isset($user)): ?>
            <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['mail']) ?></p>
            <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['telephone']) ?></p>
        <?php else: ?>
            <p>Utilisateur non trouvé.</p>
        <?php endif; ?>
    </section>

    <?php $rendezvousTotal = isset($rendezvousList) ? count($rendezvousList) : 0;?>

    <section >
        <h3 style=>Résumé :</h3>
        <div class='resume'>
            <p><strong>Nombre total de patients :</strong> <?= $nombrePatients ?></p>
            <p><strong>Nombre total de rendez-vous :</strong> <?= $rendezvousTotal ?></p>
            
            <?php $avisManager = new AvisManager();
            $noteMoyenne = $avisManager->getMoyenneNote();?>
            <p><strong>Note moyenne : </strong> <?= $noteMoyenne ?>/5</p>

        </div>
    </section>

    <section>
        <h3>Actions disponibles :</h3>
        <div class='actions'>
            <div>
                <p><a href="index.php?action=listeutilisateurs">Liste des utilisateurs</a></p>
                <p><a href="index.php?action=listerendezvous">Liste des rendez-vous</a></p>
                <p><a href="index.php?action=modifierhoraire">Modifier les horaires</a></p>
            </div>
            <div>
                <p><a href="index.php?action=actualiteadmin">Modifier vos actualités</a></p>
                <p><a href="index.php?action=servicesadmin">Modifier vos services</a></p>
                <p><a href="index.php?action=aproposadmin">Modifier section a propos</a></p>
            </div>
            
        </div>
        
    </section>
    <section class='deconnexion'>
        <p><a href="index.php?action=deconnexion">Se déconnecter</a></p>
    </section>

