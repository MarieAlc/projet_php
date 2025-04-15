<?php
    echo("<h1>Actualitées</h1>");
    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

    for ($i=0; $i < count($listeActualites); $i++){ 
        $actualiteTitre = $listeActualites[$i]-> getTitre();
        $actualiteContenu = $listeActualites[$i]-> getContenu();
        $actualiteDate = $listeActualites[$i]->getDate();
        

        $actualiteDateFormate = strftime('%d %B %Y', $actualiteDate->getTimestamp());
    
         echo  "<h3>$actualiteTitre</h3>";
         echo  "<p>$actualiteContenu</p>";
         echo "<p><em>Publié le $actualiteDateFormate</em></p>";
    }
