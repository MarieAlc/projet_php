<h2 style="text-align: center; color: #2c3e50;">Espace Administrateur</h2>
<?php 

if (!empty($_SESSION['message'])): ?>
    <div style="color: green;text-align: center; margin: 20px auto; padding: 10px; ">
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div style="display: flex; justify-content: space-between; align-items: center; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
    <?php if (isset($user)): ?>
        <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($user['mail']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['telephone']) ?></p>
    <?php else: ?>
        <p>Utilisateur non trouvé.</p>
    <?php endif; ?>
</div>



<?php

$rendezvousTotal = isset($rendezvousList) ? count($rendezvousList) : 0;
?>

<h3 style="color: #34495e;text-align:center;">Résumé :</h3>
<div style="max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
    <p><strong>Nombre total de patients :</strong> <?= $nombrePatients ?></p>
    <p><strong>Nombre total de rendez-vous :</strong> <?= $rendezvousTotal ?></p>
</div>

<h3 style="color: #34495e;text-align:center;">Actions disponibles :</h3>
<div style = " display: flex; justify-content: space-around; align-items: center; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
    <div>
        <p><a href="index.php?action=listeutilisateurs">Liste des utilisateurs</a></p>
        <p><a href="index.php?action=listerendezvous">Liste des rendez-vous</a></p>
        <p><a href="index.php?action=modifierhoraire">Modifier les horaires</a></p>
    </div>
    <div>
        <p><a href="index.php?action=actualiteadmin">Modifier vos actualités</a></p>
        <p><a href="index.php?action=servicesadmin">Modifier vos services</a></p>
        <p><a href="index.php?action=deconnexion">Se déconnecter</a></p>
    </div>

</div>


