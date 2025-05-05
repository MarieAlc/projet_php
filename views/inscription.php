<h2>Inscription</h2>

<?php if (!empty($errors)): ?>
    <div class="form-errors">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="form-container">
    <form action="/test/projet_php/index.php?action=inscription" method="post">
        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Prénom :</label>
        <input type="text" name="prenom" required>

        <label>Email :</label>
        <input type="email" name="mail" required>

        <label>Téléphone :</label>
        <input type="tel" name="telephone" required>

        <label>Mot de passe :</label>
        <input type="password" name="motDePasse" required>

        <input type="submit" value="S'inscrire">
    </form>

    <p class="form-link">Déjà inscrit ? <a href="index.php?action=connexion">Connectez-vous ici</a></p>
</div>
