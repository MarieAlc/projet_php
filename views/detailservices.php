<div class="datailService">

<?php
if($service){

    echo ("<h2>" . $service->getNom() . "</h2>");
    echo ("<p>" . $service->getDescription() . $service->getPrix() . "</p>" . "<br/>");
    echo ("<p>" . $service->getPrix() . "€</p>" . "<br/>");
}else{
    echo("Le service n'existe pas");
}

?>

</div>