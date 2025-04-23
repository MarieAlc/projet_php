<?php   

class ControllerProfil extends Controller {

    public function showProfil(){ 

        $this->verifierConnexion();
        $user = $_SESSION['user'];
        $idClient = $user['id']; 

        $rendezVousManager = new RendezVousManager();
        $serviceManager = new ServiceManager();

        $rendezvousList = $rendezVousManager->getRendezVousUtilisateur($idClient);

        foreach ($rendezvousList as $rdv) {
            $service = $serviceManager->getService($rdv->getMotif());
            $rdv->nomService = $service ? $service->getNom() : 'Inconnu';
        }

        $views = new Views();
        $views->render('profil', ['user' => $user,'rendezvousList' => $rendezvousList]);
    }

    public function showProfilAdmin(){ 
        $this->verifierConnexion();
        $user = $_SESSION['user'];

        $rendezVousManager = new RendezVousManager();
        $serviceManager = new ServiceManager();
        $rendezvousList = $rendezVousManager->getListeRendezVous();

        foreach ($rendezvousList as $rdv) {
            $service = $serviceManager->getService($rdv->getMotif());
            $rdv->nomService = $service ? $service->getNom() : 'Inconnu';
        }

        $views = new Views();
        $views->render('profiladmin', ['user' => $user, 'rendezvousList' => $rendezvousList]);
    }
    
    public function deconnexion(){

        session_destroy();
        header('Location: /test/projet_php/index.php?action=accueil');
        exit;
    }

   

}