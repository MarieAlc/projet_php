<?php
include_once 'config/config.php';
include_once 'models/Services/Service.php';
include_once 'models/Services/ServiceManager.php';
include_once 'models/Actualites/Actualites.php';
include_once 'models/Actualites/ActualitesManager.php';
include_once 'models/Horaires/Horaire.php';
include_once 'models/Horaires/HoraireManager.php';
include_once 'views/Views.php';
include_once 'controllers/Controller.php';


$action = $_REQUEST['action'] ?? 'accueil';

try {
    $controller = new Controller();

    switch ($action) {
        case 'accueil':
            $controller -> showAccueil();
          
            break;
    
    
        case 'listeservices':        
            $controller -> showListeServices();
            break;
    
        case 'detailservices':
            $controller -> showDetailService();
            break;

        case 'actualites':
            $controller -> showListeActualites();
            break;

        case 'apropos':

            break;
    
    
        default:
            echo('<h1>Erreur 404</h1>');
            break;
    }

} catch (\Throwable $th) {
    echo('<h1>Erreur 404</h1>');
    var_dump($th);
}


