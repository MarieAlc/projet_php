<?php
function showListeServices(){
    $listeServices = getListeServices();
    render("listeServices", [
        'listeServices' => $listeServices
    ]);


}

function showDetailService(){
    $service= getService();
    displayDetailService($service);
}
    