<h2>Modifier l'actualité</h2>
<form action="index.php?action=modifieractualite&id=<?= $id ?>" method="post">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value="<?= $titre ?>" required>

    <label for="contenu">Contenu</label>
    <textarea name="contenu" id="contenu" required><?= $contenu ?></textarea>

    <input type="hidden" name="id" value="<?= $id ?>">
    <button type="submit">Enregistrer les modifications</button>
</form>
