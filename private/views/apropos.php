<?php
    for ($i=0; $i < count($apropos); $i++){ 
        $aproposTitre = $apropos[$i]-> getTitre();
        $aproposTexte = $apropos[$i]-> getTexte();
        
        echo("<section class='apropos'>");
        echo  "<h3>$aproposTitre</h3>";
        echo  "<p>$aproposTexte</p>";
        echo("</section>");
    }