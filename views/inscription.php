
<h2>Inscription</h2>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="/test/projet_php/index.php?action=inscription" method="post">

    <label>Nom :</label>
    <input type="text" name="nom" required><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required><br>

    <label>Email :</label>
    <input type="email" name="mail" required><br>

    <label>Téléphone :</label>
    <input type="tel" name="telephone" required><br>

    <label>Mot de passe :</label>
    <input type="password" name="motDePasse" required><br>

    <input type="submit" value="S'inscrire">
</form>

<p>Déjà inscrit ? <a href="index.php?action=connexion">Connectez-vous ici</a></p>