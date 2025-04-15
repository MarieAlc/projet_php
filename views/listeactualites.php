<?php
    echo("<h1>Actualitées</h1>");

    for ($i=0; $i < count($listeActualites); $i++){ 
        $actualite = $listeActualites[$i]-> getTitre();
   
        echo($actualite);


    } 
