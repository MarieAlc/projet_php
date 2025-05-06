<?php
// Affichage des erreurs
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo "<div class='confirmation-erreur'>$error</div>";
    }
    unset($_SESSION['errors']);
}

// Affichage du message de succès
if (isset($_SESSION['message'])) {
    echo "<div class='confirmation-message'>".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
}
?>

<h2>Modifier un utilisateur</h2>

<div class="form-container">
    <form action="index.php?action=modifierutilisateur" method="post">
        <input type="hidden" name="userId" value="<?= htmlspecialchars($utilisateur['id']) ?>">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" required><br><br>

        <label for="mail">Email :</label>
        <input type="email" name="mail" id="mail" value="<?= htmlspecialchars($utilisateur['mail']) ?>" required><br><br>

        <label for="telephone">Téléphone :</label>
        <input type="tel" name="telephone" id="telephone" value="<?= htmlspecialchars($utilisateur['telephone']) ?>" required><br><br>  
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" name="motDePasse" id="motDePasse"  required><br><br>  

        <button type="submit">Mettre à jour</button>
    </form>
</div>


