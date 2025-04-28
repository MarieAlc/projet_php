<?php

include_once 'incluse.php';


$action = $_REQUEST['action'] ?? 'accueil';

try {
    $controller = new Controller();
    $controllerUtilisateur = new ControllerUtilisateur();
    $controllerProfil = new ControllerProfil();
    $controllerAdmin = new ControllerAdmin();
    $controllerRendezVous = new ControllerRendezVous();
    $controllerActualite = new ControllerActualite();
    $controllerHoraire = new ControllerHoraire();
    $controllerGestionUtilisateur = new ControllerGestionUtilisateur();

    switch ($action) {

        case 'accueil':
            $controller->showAccueil();          
            break;
        case 'listeservices':        
            $controller->showListeServices();
            break;
        
        case 'detailservices':
            $controller->showDetailService();
            break;
    
        case 'actualites':
            $controller->showListeActualites();
            break;
    
        case 'apropos':
            $controller->showApropos();
            break;

            
        case 'inscription':
            $controllerProfil->showInscription();
            break;
                
        case 'connexion':
            $controllerProfil->showConnexion();    
            break;    
                    
        case 'verifConnexion':
            $controllerProfil->verifConnexion();
            break;
                        
        case 'deconnexion':                    
            $controllerProfil->deconnexion();
            break;
                            
        case 'profil':
            $controllerProfil->showProfil();
            break;
                                
        case 'profiladmin':
            $controllerProfil->showProfilAdmin();
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


        case 'modifieradmin':
            $controllerAdmin->modifierRoleUtilisateur();
            break;

        case 'listeutilisateurs':
            $controllerAdmin->showListeUtilisateurs();
            break;
        
        case 'listerendezvousutilisateur':
            $controllerGestionUtilisateur->afficherRendezVousUtilisateur();
            break;
















            

        case 'actualiteadmin':
            $controllerActualite->showActualitesAdmin();
            break;

        case 'ajouteractualite':
            $controllerActualite->ajouterActualite();
            break;
        case 'modifieractualite':
            $controllerActualite->modifierActualite();
            break;
        case 'supprimeractualite':
            $controllerActualite->supprimerActualite();
            break;

        case 'modifierhoraire':
            $controllerHoraire->modifierHoraire();
            break;

        case 'validerrendezvous':
            $controllerRendezVous->validerRendezvous();
            break;







        default:
            echo('<h1>Erreur 404</h1>');
            break;
    }

} catch (\Throwable $th) {
    echo('<h1>Erreur 404</h1>');
    var_dump($th);
}


