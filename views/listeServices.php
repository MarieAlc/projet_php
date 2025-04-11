<?php
    echo("<h1>Liste des services</h1>");

    for ($i=0; $i < count($listeServices); $i++){ 
        $service = $listeServices[$i]-> getNom();
        $id = $listeServices[$i]-> getId();


        echo ("<a href=\"index.php?action=detailservices&id=$id\"> $service </a> <br/>");
    } 
