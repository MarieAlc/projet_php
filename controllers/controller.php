<?php

class Controller {

    function showListeServices(){
        $serviceManager = new serviceManager();
        $listeServices = $serviceManager -> getListeServices();

        $views = new Views();
        $views -> render("listeServices", [
            'listeServices' => $listeServices
        ]);


    }

    function showDetailService(){
        $serviceManager = new serviceManager();
        $id = $_REQUEST['id'] ?? -1;
        $service= $serviceManager -> getService($id);

        $views = new Views();
        $views->render("detailservices", [
            'service' => $service
        ]);
    }
 
}