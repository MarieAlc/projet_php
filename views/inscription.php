<h2>Inscription</h2>
<form action="index.php?action=verifInscription" method="post">
    <label>Nom :</label>
    <input type="text" name="nom" required><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required><br>

    <label>Email :</label>
    <input type="email" name="mail" required><br>

    <label>Téléphone :</label>
    <input type="tel" name="telephone" required><br>

    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br>

    <input type="submit" value="S'inscrire">
</form>
<p>Déjà inscrit ? <a href="index.php?action=connexion">Connectez-vous ici</a></p>