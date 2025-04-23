<?php

include_once 'incluse.php';


$action = $_REQUEST['action'] ?? 'accueil';

try {
    $controller = new Controller();
    $controllerUtilisateur = new ControllerUtilisateur();
    $controllerProfil = new ControllerProfil();
    $controllerAdmin = new ControllerAdmin();
    $controllerRendezVous = new ControllerRendezVous();

    switch ($action) {
        case 'accueil':
            $controller->showAccueil();          
            break;

        case 'prendrerendezvous':
            $controller->showPrendreRendezVous();
            break;
        case 'validerrdv':
            $controllerRendezVous->prendreRendezVous();
            break;
        case 'confirmationrdv':
            $controllerRendezVous->showConfirmationRendezVous();
            break;
        case 'listerendezvous':
            $controllerRendezVous->listerRendezVous();
            break;

        case 'modifierrendezvous':
            $controllerRendezVous->modifierRendezVous();
            break;
        
            case 'supprimerRendezVous':
                $controllerRendezVous->supprimerRendezVous();
                break;
    
    
        case 'listeservices':        
            $controller->showListeServices();
            break;
    
        case 'detailservices':
            $controller->showDetailService();
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
                $controllerProfil->deconnexion();
                 break;
                
        case 'profil':
            $controllerProfil -> showProfil();
            break;

        case 'profiladmin':
            $controllerProfil -> showProfilAdmin();
            break;

        case 'modifieradmin':
            $controllerAdmin-> modifierRoleUtilisateur();
            break;

        case 'listeutilisateurs':
            $controllerAdmin -> showListeUtilisateurs();
            break;

        default:
            echo('<h1>Erreur 404</h1>');
            break;
    }

} catch (\Throwable $th) {
    echo('<h1>Erreur 404</h1>');
    var_dump($th);
}


