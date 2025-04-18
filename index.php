<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once 'incluse.php';


$action = $_REQUEST['action'] ?? 'accueil';

try {
    $controller = new Controller();
    $controllerUtilisateur = new ControllerUtilisateur();

    switch ($action) {
        case 'accueil':
            $controller -> showAccueil();          
            break;

        case 'prendrerendezvous':
            $controller->showPrendreRendezVous();
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
            $controller -> showApropos();

            break;

        case 'inscription':
            $controllerUtilisateur -> showInscription();
            break;

        case 'connexion':
            $controllerUtilisateur -> showConnexion();
    
            break;    
            case 'verifConnexion':
                $controllerUtilisateur->verifConnexion();
                break;

            case 'deconnexion':                    
                $controllerUtilisateur->deconnexion();
                 break;
                
        case 'profil':
            $controllerUtilisateur -> showProfil();
            break;
    
        default:
            echo('<h1>Erreur 404</h1>');
            break;
    }

} catch (\Throwable $th) {
    echo('<h1>Erreur 404</h1>');
    var_dump($th);
}


