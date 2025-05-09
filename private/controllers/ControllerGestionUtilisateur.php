<?php   
class ControllerGestionUtilisateur extends Controller {

    public function afficherRendezVousUtilisateur() {
        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];
    
        
            $rendezvousManager = new RendezVousManager();
            $rendezvousList = $rendezvousManager->getRendezVousParUtilisateur($userId);

            $message = '';
            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
    
    
            $views = new Views();
            $views->render('utilisateur/rendezvousutilisateur', [
                'rendezvousList' => $rendezvousList,
                'message' => $message
            ]);
        } else {
            // Si l'utilisateur n'est pas connecté, redirection vers la page de connexion
            header('Location: index.php?action=connexion');
            exit;
        }
    }

    public function modifierRendezVousUtilisateur(){
        $this->verifierConnexion();
       if(isset($_GET['id'])){
            $id = $_GET['id'];
            $rendezvousManager = new RendezVousManager();
            $rdv = $rendezvousManager->getRendezVousParId($id);
            $servicesManager = new ServiceManager();
            $services = $servicesManager->getListeServices();
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rdv->setDate($_POST['date']);
                $rdv->setHeure(new DateTime($_POST['heure'])); // 
                $rdv->setMotif($_POST['motif']);
                $rdv->setMailPatient($_POST['mailPatient']);
    
                $rendezvousManager->modifierRendezVous($rdv);
                $_SESSION['message'] = "Rendez-vous modifié avec succès.";
    
               
                header('Location: index.php?action=listerendezvousutilisateur');
                exit;
            }
            $views = new Views();
            $views->render('utilisateur/modifierrendezvousutilisateur', [
                'rdv' => $rdv,
                'services' => $services,
                
            ]);
           
        }
    


    }

    public function supprimerRendezVousUtilisateur() {
        $this->verifierConnexion();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            $rendezvousManager = new RendezVousManager();
    
            $rendezvousManager->supprimerRendezVous($id);
            $_SESSION['message'] = "Rendez-vous supprimé avec succès.";
            header('Location: index.php?action=listerendezvousutilisateur');
            exit;
        } else {
            header('Location: index.php?action=listerendezvousutilisateur');
            exit;
        }
    }

    public function modifierProfilUtilisateur() {
        $this->verifierConnexion();
        $utilisateurManager = new UtilisateurManager();
        $userId = $_SESSION['user']['id'];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $telephone = $_POST['telephone'];
            $motDePasse = $_POST['motDePasse'] ?? null;
            $errors = [];

            try {
                $utilisateurManager->modifierUtilisateur($userId, $nom, $prenom, $mail,$telephone, $motDePasse);
                $utilisateur = $utilisateurManager->getUtilisateurById($userId);
                
                $_SESSION['user'] = [
                    'id' => $utilisateur->getId(),
                    'nom' => $utilisateur->getNom(),
                    'prenom' => $utilisateur->getPrenom(),
                    'mail' => $utilisateur->getMail(),
                    'telephone' => $utilisateur->getTelephone(),
                    'isAdmin' => $_SESSION['user']['isAdmin']
                ];
                $_SESSION['message'] = "Votre profil a été mis à jour avec succès.";
                header('Location: index.php?action=profil&id=' . $userId);
                exit;
            } catch (Exception $e) {
                $_SESSION['errors'] = [$e->getMessage()];
            }
        }
        if (isset($_GET['id'])) {
            $userId = $_GET['id'];
            $utilisateur = $utilisateurManager->getUtilisateurById($userId);
    
            $views = new Views();
            $views->render('utilisateur/modifierprofilutilisateur', [
                'utilisateur' => $utilisateur 
           
            ]);
        }
     
    }


}