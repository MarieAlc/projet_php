<?php

class Controller {
    protected $db;

    protected function verifierAdmin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['isAdmin'] != 1) {
            header('Location: index.php?action=profiladmin');
            exit;
        }
    }
    protected function verifierConnexion() {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=connexion');
            exit;
        }
    }

    public function showAccueil(){
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


    public function showPrendreRendezVous(){
        $views = new Views();
        $serviceManager = new ServiceManager();
        $services = $serviceManager->getListeServices();
        $views -> render("utilisateur/prendrerendezvous", ['services'=>$services]);
    }
        
    public function showListeServices(){
        $serviceManager = new serviceManager();
        $listeServices = $serviceManager -> getListeServices();

        $views = new Views();
        $views -> render("listeServices", [
            'listeServices' => $listeServices
        ]);


    }

    public function showDetailService(){
        $serviceManager = new serviceManager();
        $id = $_REQUEST['id'] ?? -1;
        $service= $serviceManager -> getService($id);

        $views = new Views();
        $views->render("detailservices", [
            'service' => $service
        ]);
    }

    public function showListeActualites(){
        $actualitesManager = new ActualitesManager();
        $listeActualites = $actualitesManager -> getListeActualites();

        $views = new Views();
        $views -> render("listeactualites", [
            'listeActualites' => $listeActualites
        ]);
    }

    public function showApropos(){
        $aproposManager = new AproposManager();
        $apropos = $aproposManager -> listeApropos();

        $views = new Views();
        $views -> render("apropos", [
            'apropos' => $apropos
        ]);
    }
   

 
}