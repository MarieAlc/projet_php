<?php
    echo("<h1>Liste des services</h1>");

    for ($i=0; $i < count($listeServices); $i++){ 
        $service = $listeServices[$i]["nom"];
        $id = $listeServices[$i]["id"];


        echo ("<a href=\"index.php?action=detailservices&id=$id\"> $service </a> <br/>");
    } 
