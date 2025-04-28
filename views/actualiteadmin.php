<?php

if (isset($_SESSION['message'])) {
    echo "<div style='background-color: #d4edda; padding: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb;'>
            " . $_SESSION['message'] . "
          </div>";
    unset($_SESSION['message']);
}

foreach ($listeActualites as $actualite) {
    $id = $actualite->getId();
    $titre = $actualite->getTitre();
    $contenu = $actualite->getContenu();
    $date = $actualite->getDate()->format('d/m/Y');

    echo "<div>";
    echo "<h3>$titre</h3>";
    echo "<p>$contenu</p>";
    echo "<p><em>Publié le $date</em></p>";

    echo "<form action='index.php?action=supprimeractualite' method='post' style='display:inline;'>
    <input type='hidden' name='id' value='$id'>
    <button type='submit'>Supprimer</button>
  </form>";
    
    echo "<form action='index.php?action=modifieractualite&id=$id' method='post'>
            <button type='submit'>Modifier</button>
          </form>";

    echo "</div>";
}


echo "<h2>Ajouter une nouvelle actualité</h2>";
echo "<form action='index.php?action=ajouteractualite' method='post'>
        <label for='titre'>Titre</label>
        <input type='text' name='titre' id='titre' required>

        <label for='contenu'>Contenu</label>
        <textarea name='contenu' id='contenu' required></textarea>

        <button type='submit'>Ajouter l'actualité</button>
      </form>";
?>