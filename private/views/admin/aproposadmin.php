<h2>Gestion des sections À propos</h2>
<?php
if (isset($_SESSION['message'])) {
    echo "<div class='confirmation-message'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']); 
}
?>

<div >
    <?php
    foreach ($apropos as $section) {
        $id = $section->getId();
        $titre = $section->getTitre();
        $texte = $section->getTexte();

        echo "<section>";
        echo "<h3>$titre</h3>";
        echo "<p>$texte</p>";

        
        echo "<a href='index.php?action=modifierapropos&id=$id' class='btn-modifier'>Modifier</a>";

   
        echo "<form action='index.php?action=supprimerapropos' method='post' style='display:inline;'>
                <input type='hidden' name='id' value='$id'>
                <button type='submit' class='btn-supprimer'>Supprimer</button>
              </form>";

        echo "</section>";
    }
    ?>
</div>

<section class="form-container">
    <h3>Ajouter une nouvelle section À propos</h3>
    <form action="index.php?action=ajouterapropos" method="post">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" required>

        <label for="texte">Description</label>
        <textarea name="texte" id="texte" required></textarea>

        <button type="submit">Ajouter</button>
    </form>
</section>
