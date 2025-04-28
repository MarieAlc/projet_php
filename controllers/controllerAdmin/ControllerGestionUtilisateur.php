<?php   
class ControllerGestionUtilisateur extends Controller {

    public function afficherRendezVousUtilisateur() {
        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];
    
        
            $rendezvousManager = new RendezVousManager();
            $rendezvousList = $rendezvousManager->getRendezVousParUtilisateur($userId);
    
    
            $views = new Views();
            $views->render('rendezvousutilisateur', [
                'rendezvousList' => $rendezvousList
            ]);
        } else {
            // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
            header('Location: /test/projet_php/index.php?action=connexion');
            exit;
        }
    }

    public function modifierUtilisateur(){
 


    }

    public function supprimerUtilisateur(){

    }

    public function ajouterUtilisateur(){

    }
}