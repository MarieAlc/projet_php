<div class="datailService">

<?php
if($service){

    echo ("<h2>" . $service->getNom() . "</h2>");
echo("<section class='detailService'>");
    echo ("<p>" . $service->getDescription() . "</p>" . "<br/>");
    echo ("<p>" . $service->getPrix() . "€</p>" . "<br/>");
    echo("</section>");
}else{
    echo("Le service n'existe pas");
}

?>

</div>