<?php
    echo("<h1>A Propos de nous </h1>");
    for ($i=0; $i < count($apropos); $i++){ 
        $aproposTitre = $apropos[$i]-> getTitre();
        $aproposTexte = $apropos[$i]-> getTexte();
        
        echo  "<h3>$aproposTitre</h3>";
        echo  "<p>$aproposTexte</p>";
    }