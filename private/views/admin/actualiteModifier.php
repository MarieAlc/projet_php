<h2>Modifier l'actualité</h2>

    <div class="form-container">

        <form action="index.php?action=modifieractualite&id=<?= $id ?>" method="post" enctype="multipart/form-data" >

            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="<?= $titre ?>" required>
        
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" required><?= $contenu ?></textarea>
            
            <label for="photo">Photo (optionnel):</label>
            <input type="file" id="photo" name="photo">
        
            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit">Enregistrer les modifications</button>
        </form>
    </div>

