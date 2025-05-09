<?php
echo("<h2>Actualités</h2>");
setlocale(LC_TIME, 'fr_FR.UTF-8'); 

echo '<section>';
foreach ($listeActualites as $actualite) {
    $actualiteTitre = $actualite->getTitre();
    $actualiteContenu = $actualite->getContenu();
    $actualiteDate = $actualite->getDate(); 

    $actualiteDateFormatee = $actualiteDate->format('d m Y'); 
    $photo = $actualite->getPhoto();

    echo '<div class="actualite">';
    echo "<h3>$actualiteTitre</h3>";
    echo "<p>$actualiteContenu</p>";

    if ($photo) {
        echo "<img src='" . $photo . "' alt='" . $actualiteTitre . "'>";
        
    }

    echo "<p><em>Publié le $actualiteDateFormatee</em></p>";
    echo "</div>";
}
echo '</section>';
?>