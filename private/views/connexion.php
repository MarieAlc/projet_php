<?php 
if (!empty($_SESSION['message'])): ?>
    <div class="confirmation-message">
        <?= htmlspecialchars($_SESSION['message']) ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<h2>Connectez-vous</h2>

<div class="form-container">
    <form action="index.php?action=verifConnexion" method="post">
        <label>Email :</label>
        <input type="email" name="mail" required>

        <label>Mot de passe :</label>
        <input type="password" name="motDePasse" required>

        <input type="submit" value="Se connecter">

        <p class="form-link"><a href="index.php?action=inscription">Créer un compte</a></p>
        <p class="form-link"><a href="index.php?action=motdepasseoublie">Mot de passe oublié</a></p>
    </form>
</div>