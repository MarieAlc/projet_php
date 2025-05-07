<h2> Modifier votre profil </h2>

<div class="form-container">

    <form method="post" action="index.php?action=modifierprofilutilisateur&id=<?php echo $_SESSION['user']['id']; ?>">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($utilisateur->getNom()); ?>" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($utilisateur->getPrenom()); ?>" required><br>

        <label for="mail">Email :</label>
        <input type="email" id="mail" name="mail" value="<?php echo htmlspecialchars($utilisateur->getmail()); ?>" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="tel" name="telephone" id="telephone" value="<?= htmlspecialchars($utilisateur->getTelephone()) ?>" required><br><br>   

        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse"><br>

        <input type="submit" value="Modifier"> 
</div>