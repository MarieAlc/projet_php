<h2>Modifier la section "À propos"</h2>

<div class="form-container">
    <form action="index.php?action=modifierapropos&id=<?= $id ?>" method="post">
        
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($aproposTitre) ?>" required>

        <label for="texte">Description</label>
        <textarea name="texte" id="texte" required><?= htmlspecialchars($aproposTexte) ?></textarea>
        
        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>
