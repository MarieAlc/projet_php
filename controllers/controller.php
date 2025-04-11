<?php

class Controller {

    function showListeServices(){
        $model = new Model();
        $listeServices = $model -> getListeServices();

        $views = new Views();
        $views -> render("listeServices", [
            'listeServices' => $listeServices
        ]);


    }

    function showDetailService(){
        $model = new Model();
        $id = $_REQUEST['id'] ?? -1;
        $service= $model -> getService($id);

        $views = new Views();
        $views->render("detailservices", [
            'service' => $service
        ]);
    }
 
}