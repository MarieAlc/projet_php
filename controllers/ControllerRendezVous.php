<?php   

class ControllerRendezVous extends Controller {

    public function prendreRendezVous() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SESSION['user'])) {
                $nom = $_SESSION['user']['nom'];
                $prenom = $_SESSION['user']['prenom'];
                $mail = $_SESSION['user']['mail'];
                $idClient = $_SESSION['user']['id'];
            } else {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $mail = $_POST['mail'];
                $idClient = null; 
            }
    
            $date = $_POST['date'];
            $heureStr = $_POST['heure'];
            $dateTimeStr = $date . ' ' . $heureStr;
            try {
                $heure = new DateTime($dateTimeStr);
            } catch (Exception $e) {
                // Gestion de l'erreur si la chaîne de date/heure n'est pas valide
                die("Erreur lors de la création de l'objet DateTime : " . $e->getMessage());
            }

            $motif = $_POST['motif'];
    
            $rdv = new RendezVous([
                'date' => $date,
                'heure' => $heure instanceof DateTime ? $heure : new DateTime($heure),
                'motif' => $motif,
                'idClient' => $idClient,
                'mailPatient' => $mail
            ]);
    
            $rendezvousManager = new RendezVousManager();
            $rendezvousManager->ajouterRendezVous($rdv);
    
            $_SESSION['confirmation_rdv'] = [
                'nom' => $nom,
                'prenom' => $prenom,
                'date' => $date,
                'heure' => $heure->format('H:i'),
                'motif' => $motif
            ];
    
            header('Location: index.php?action=confirmationrdv');
            exit;
        }
    
    }
    public function showConfirmationRendezVous() {
        $this->verifierConnexion();
        $confirmation = $_SESSION['confirmation_rdv'] ?? null;

        if ($confirmation) {
            $serviceManager = new ServiceManager();
            $service = $serviceManager->getService($confirmation['motif']);
            $confirmation['motif_nom'] = $service ? $service->getNom() : 'Inconnu';
        }
    
        $views = new Views();
        $views->render('rendezvousutilisateur', ['confirmation' => $confirmation]);
    
        unset($_SESSION['confirmation_rdv']); // on efface après affichage
    }
    public function listerRendezVous() {
        // Vérifie si l'utilisateur est un admin
        $this->verifierAdmin();

        // Récupère la liste des rendez-vous
        $rendezVousManager = new RendezVousManager();
        $rendezvousList = $rendezVousManager->getListeRendezVous();
        $serviceManager = new ServiceManager();
        foreach ($rendezvousList as $rdv) {
            $service = $serviceManager->getService($rdv->getMotif()); 
            $rdv->setMotifNom($service ? $service->getNom() : 'Inconnu');
        }


        // Passe la liste des rendez-vous à la vue
        $views = new Views();
        $views->render('listerendezvous', ['rendezvousList' => $rendezvousList]);
    }
    public function supprimerRendezVous() {
        $this->verifierAdmin();

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
    
            $rendezvousManager = new RendezVousManager();
    
            // Supprimer le rendez-vous de la base de données
            $rendezvousManager->supprimerRendezVous($id);
            $_SESSION['message'] = "Rendez-vous supprimé avec succès.";
            header('Location: /test/projet_php/index.php?action=listerendezvous');
            exit;
        } else {
            header('Location: /test/projet_php/index.php?action=listerendezvous');
            exit;
    }
    }
    public function modifierRendezVous() {
        $this->verifierAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
    
            $rendezvousManager = new RendezVousManager();
            $rdv = $rendezvousManager->getRendezVousParId($id);
            $serviceManager = new ServiceManager();
            $services = $serviceManager->getListeServices(); 
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $rdv->setDate($_POST['date']);
                $rdv->setHeure(new DateTime($_POST['heure'])); // Assure-toi que l'heure est convertie en objet DateTime
                $rdv->setMotif($_POST['motif']);
                $rdv->setMailPatient($_POST['mailPatient']);
    
                // Modification dans la base de données
                $rendezvousManager->modifierRendezVous($rdv);
    
                // Message de succès
                $_SESSION['message'] = "Rendez-vous modifié avec succès.";
                header('Location: /test/projet_php/index.php?action=listerendezvous');
                exit;
            }
    
            // Affichage du formulaire de modification
            $views = new Views();
            $views->render('modifierRendezVous', ['rdv' => $rdv, 'services' => $services]);
        } else {
            // Rediriger si l'id est manquant
            header('Location: /test/projet_php/index.php?action=listerendezvous');
            exit;
        }
    }
    


} 