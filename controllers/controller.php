<?php

class Controller {

    protected function verifierAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] != 1) {
            header('Location: /test/projet_php/index.php?action=profiladmin');
            exit;
        }
    }
    protected function verifierConnexion() {
        if (!isset($_SESSION['user'])) {
            header('Location: /test/projet_php/index.php?action=connexion');
            exit;
        }
    }

    function showAccueil(){
        $views = new Views();

        $servicesManager = new ServiceManager();  
        $services = $servicesManager->getListeServices(); 

        $horaireManager = new HoraireManager();
        $horaires = $horaireManager->getListeHoraires(); 

        $presentationManager = new PresentationManager();
        $presentation = $presentationManager->getPresentation();
        
        $data = [
            
            'presentation' => $presentation,
            'services' => $services, 
            'horaires' => $horaires
        ];
        
        // Rendu de la vue d'accueil avec les données
        $views->render("accueil", $data);
    
    }


    function showPrendreRendezVous(){
        $views = new Views();
        $serviceManager = new ServiceManager();
        $services = $serviceManager->getListeServices();
        $views -> render("prendrerendezvous", ['services'=>$services]);
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

    function showApropos(){
        $aproposManager = new AproposManager();
        $apropos = $aproposManager -> listeApropos();

        $views = new Views();
        $views -> render("apropos", [
            'apropos' => $apropos
        ]);
    }

 
}