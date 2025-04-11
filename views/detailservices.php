<?php
if($service){

    echo ("<h2>" . $service["nom"] . "</h2>");
    echo ($service["description"]);
}else{
    echo("Le service n'existe pas");
}