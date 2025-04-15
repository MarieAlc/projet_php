<?php

class Controller {

    function showAccueil(){
        $views = new Views();
        $servicesManager = new ServiceManager();  
        $services = $servicesManager->getListeServices(); 
        $horaireManager = new HoraireManager();
        $horaires = $horaireManager->getListeHoraires(); 
        $data = [
            
            'presentation' => 'Dr. Dupont est un spécialiste en dentisterie...',
            'services' => $services, 
            'horaires' => $horaires
        ];
        
        // Rendu de la vue d'accueil avec les données
        $views->render("accueil", $data);
    
    }
        
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

    function showListeActualites(){
        $actualitesManager = new ActualitesManager();
        $listeActualites = $actualitesManager -> getListeActualites();

        $views = new Views();
        $views -> render("listeActualites", [
            'listeActualites' => $listeActualites
        ]);
    }

 
}