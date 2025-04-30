<h1>Ajouter un avis</h1>

<form action="index.php?action=ajouteravis" method="post" enctype="multipart/form-data">

<label for="nomPatient">Nom du patient:</label>
<input type="text" id="nomPatient" name="nomPatient" required>

    <label for="note">Note (1 à 5):</label>
    <input type="number" id="note" name="note" min="1" max="5" required>

    <label for="commentaire">Commentaire:</label>
    <textarea id="commentaire" name="commentaire" required></textarea>

    <label for="photo">Photo (optionnel):</label>
    <input type="file" id="photo" name="photo">

    <button type="submit">Ajouter l'avis</button>
</form>

<p><a href="index.php?action=avis">Retour aux avis</a></p>
