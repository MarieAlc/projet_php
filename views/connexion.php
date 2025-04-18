<?php 

if (!empty($_SESSION['message'])): ?>
    <div style="color: green;">
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <?php unset($_SESSION['message']); // Efface le message après l'affichage ?>
<?php endif; ?>

<h2>Connectez-vous</h2>

<form action="index.php?action=verifConnexion" method="post">

    
    <label>Email :</label>
    <input type="email" name="mail" required><br>
    
    <label>Mot de passe :</label>
    <input type="password" name="motDePasse" required><br>
    
    <input type="submit" value="Se connecter">
</form>

