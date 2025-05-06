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
    $controllerService = new ControllerServices();
    $controllerAvis = new ControllerAvis();
    $controllerApropos = new ControllerApropos();

    switch ($action) {

        // page front pour tous

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
        case 'motdepasseoublie':
            $controllerProfil->showMotDePasseOublie();
            break;
        case 'avis':
            $controllerAvis->afficherAvis();
            break;
        case 'formulaireavis':
            $controllerAvis->afficherFormulaireAvis();
            break;
        case 'ajouteravis':
            $controllerAvis->ajouterAvis();
            break;


//coté admin
        case 'profiladmin':
            $controllerProfil->showProfilAdmin();
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
            
        case 'ajouterutilisateur':
            $controllerAdmin->ajouterUtilisateur();
            break;

        case 'modifierutilisateur':
            $controllerAdmin->modifierUtilisateur();
            break;

        case 'supprimerUtilisateur':
            $controllerAdmin->supprimerUtilisateur();
            break;

        case 'servicesadmin':
            $controllerService->showServicesAdmin();
            break;
        case 'ajouterService':
            $controllerService->ajouterService();
            break;

        case 'supprimerService':
            $controllerService->supprimerService();
            break;

        case 'modifierservice':
            $controllerService->modifierService();
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

        case 'aproposadmin':
            $controllerApropos->aproposAdmin();
            break;

        case 'modifierapropos':
            $controllerApropos->modifierApropos();
            break;
        case 'supprimerapropos':
            $controllerApropos->supprimerApropos();
            break;

        case 'ajouterapropos':
            $controllerApropos->ajouterApropos();
            break;
                                    
                                    // coté utilisateur
        case 'profil':
            $controllerProfil->showProfil();
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
                                    
        case 'listerendezvousutilisateur':
            $controllerGestionUtilisateur->afficherRendezVousUtilisateur();
            break;

        case 'modifierrendezvousutilisateur':
            $controllerGestionUtilisateur->modifierRendezVousUtilisateur();
            break;

        case 'supprimerRendezVousUtilisateur':
            $controllerGestionUtilisateur->supprimerRendezVousUtilisateur();
            break;

        case 'modifierprofilutilisateur':
            $controllerGestionUtilisateur->modifierProfilUtilisateur();
            break;






        default:
            echo('<h1>Erreur 404</h1>');
            break;
    }


} catch (\Throwable $th) {
    echo('<h1>Erreur 404</h1>');
    var_dump($th);
}


