<?php
if (!empty($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo "<div class='confirmation-erreur'>$error</div>";
    }
    unset($_SESSION['errors']);
}

if (!empty($_SESSION['message'])) {
    echo "<div class='confirmation-message'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
}
?>

<h2>Demande de réinitialisation</h2>
<p style='text-align:center'>Entrez votre adresse mail. Un administrateur traitera votre demande manuellement.</p>

<div class='form-container'>

    
    <form method="post" action="index.php?action=motdepasseoublie">
        <label for="mail">Votre adresse mail :</label><br>
        <input type="email" name="mail" id="mail" required><br><br>
        <button type="submit">Envoyer la demande</button>
    </form>

</div>