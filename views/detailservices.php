<?php
if($service){

    echo ("<h2>" . $service-> getNom() . "</h2>");
    echo ($service-> getDescription() . "<br/>");
}else{
    echo("Le service n'existe pas");
}