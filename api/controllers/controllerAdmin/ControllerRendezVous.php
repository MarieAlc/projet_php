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
        $views->render('utilisateur/confirmationrendezvousutilisateur', ['confirmation' => $confirmation]);
    
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
        $nonConfirmes = array_filter($rendezvousList, function($rdv) {
            return $rdv->getStatut() == 0; 
        });
    
        $confirmes = array_filter($rendezvousList, function($rdv) {
            return $rdv->getStatut() == 1; // Statut 1 pour confirmé
        });


        // Passe la liste des rendez-vous à la vue
        $views = new Views();
        $views->render('admin/listerendezvous', [
            'rendezvousnonConfirmes' => $nonConfirmes,
            'rendezvousconfirmes' => $confirmes
        ]);
    }
    public function supprimerRendezVous() {
        $this->verifierAdmin();

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
    
            $rendezvousManager = new RendezVousManager();
    
            $rendezvousManager->supprimerRendezVous($id);
            $_SESSION['message'] = "Rendez-vous supprimé avec succès.";
            header('Location: /test/projet_php/public/index.php?action=listerendezvous');
            exit;
        } else {
            header('Location: /test/projet_php/public/index.php?action=listerendezvous');
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
                header('Location: /test/projet_php/public/index.php?action=listerendezvous');
                exit;
            }
    
            // Affichage du formulaire de modification
            $views = new Views();
            $views->render('admin/modifierRendezVous', ['rdv' => $rdv, 'services' => $services]);
        } else {
            // Rediriger si l'id est manquant
            header('Location: /test/projet_php/public/index.php?action=listerendezvous');
            exit;
        }
    }
    public function validerRendezvous() {
        $id=$_GET['id'] ?? null; 
        if (empty($id) || !is_numeric($id)) {
            $_SESSION['message'] = "L'ID du rendez-vous est invalide.";
            header('Location: public/index.php?action=listerendezvous');
            exit;
        }
        $rendezvousManager = new RendezvousManager($this->db);
        $rendezvous = $rendezvousManager->getRendezVousParId($id);

        if (!$rendezvous) {
            $_SESSION['message'] = "Rendez-vous introuvable.";
            header('Location: public/index.php?action=listerendezvous');
            exit;
        }
        $updateSuccess = $rendezvousManager->updateStatutRendezvous($id, 1); // 1 pour "validé"
    
        if ($updateSuccess) {
            $this->envoyerEmailConfirmation($rendezvous);

            $_SESSION['message'] = "Le rendez-vous a été confirmé avec succès!";
        } else {

            $_SESSION['message'] = "Échec de la confirmation du rendez-vous.";
        }

        header('Location: public/index.php?action=listerendezvous');
        exit;
    }
    
    private function envoyerEmailConfirmation($rendezvous) {
        // Récupérer l'email du patient et les informations du rendez-vous
        $email_patient = $rendezvous->getMailPatient();
        $date_rdv = $rendezvous->getDate();
        $heure_rdv = $rendezvous->getHeure()->format('H:i');
        $services = $rendezvous->getMotifNom();
    
        $subject = "Confirmation de votre rendez-vous chez Dr. Dupont";
        $message = "Bonjour,\n\nVotre rendez-vous a été confirmé.\n\nRésumé de votre rendez-vous :\n";
        $message .= "Date : " . $date_rdv . "\n";
        $message .= "Heure : " . $heure_rdv . "\n";
        $message .= "Service : " . $services . "\n\nMerci de votre confiance.\n\nCordialement,\nL'équipe Dr. Dupont";
        $headers = "From: \"Cabinet Dr. Dupont\" <no-reply@alwaysdata.net>";
    
        mail($email_patient, $subject, $message, $headers);
    
      
    }
}

    
    


