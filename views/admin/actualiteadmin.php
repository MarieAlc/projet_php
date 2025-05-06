<?php

if (isset($_SESSION['message'])) {
    echo "<div class='confirmation-message'>
            " . $_SESSION['message'] . "
          </div>";
    unset($_SESSION['message']);
}

foreach ($listeActualites as $actualite) {
    $id = $actualite->getId();
    $titre = $actualite->getTitre();
    $contenu = $actualite->getContenu();
    $photo = $actualite->getPhoto(); 
    $date = $actualite->getDate()->format('d/m/Y');

    echo "<section class='actualiteAdmin'>";
    echo "<h3>$titre</h3>";
    echo "<p>$contenu</p>";
    if ($photo) {
      echo "<img src='$photo' alt='Image de l'actualité' class='actualite-photo'>";
  } else {
      echo "<p>Aucune photo pour cette actualité.</p>";
  }
    echo "<p><em>Publié le $date</em></p>";

    echo "<form action='index.php?action=supprimeractualite' method='post' >
    <input type='hidden' name='id' value='$id'>
    <button type='submit' class='suppActu'>Supprimer</button>
  </form>";
    
    echo "<form action='index.php?action=modifieractualite&id=$id' method='post'>
            <button type='submit' class='modifActu'>Modifier</button>
          </form>";

    echo "</section>";
}

echo "<section class='form-container'>";
echo "<h2>Ajouter une nouvelle actualité</h2>";
echo "<form action='index.php?action=ajouteractualite' method='post' enctype='multipart/form-data'>
        <label for='titre'>Titre</label>
        <input type='text' name='titre' id='titre' required>

        <label for='contenu'>Contenu</label>
        <textarea name='contenu' id='contenu' required></textarea>

        <label for='photo'>Photo (optionnel):</label>
        <input type='file' id='photo' name='photo'>

        <button type='submit'>Ajouter l'actualité</button>
      </form>";
echo"</section>";
?>