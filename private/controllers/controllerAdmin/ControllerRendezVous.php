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
            header('Location: index.php?action=listerendezvous');
            exit;
        } else {
            header('Location: index.php?action=listerendezvous');
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
                header('Location: index.php?action=listerendezvous');
                exit;
            }
    
            // Affichage du formulaire de modification
            $views = new Views();
            $views->render('admin/modifierrendezvous', ['rdv' => $rdv, 'services' => $services]);
        } else {
            // Rediriger si l'id est manquant
            header('Location: index.php?action=listerendezvous');
            exit;
        }
    }
    public function validerRendezvous() {
        $id=$_GET['id'] ?? null; 
        if (empty($id) || !is_numeric($id)) {
            $_SESSION['message'] = "L'ID du rendez-vous est invalide.";
            header('Location: index.php?action=listerendezvous');
            exit;
        }
        $rendezvousManager = new RendezvousManager($this->db);
        $rendezvous = $rendezvousManager->getRendezVousParId($id);

        if (!$rendezvous) {
            $_SESSION['message'] = "Rendez-vous introuvable.";
            header('Location: index.php?action=listerendezvous');
            exit;
        }
        $updateSuccess = $rendezvousManager->updateStatutRendezvous($id, 1); // 1 pour "validé"
    
        if ($updateSuccess) {
            $this->envoyerEmailConfirmation($rendezvous);

            $_SESSION['message'] = "Le rendez-vous a été confirmé avec succès!";
        } else {

            $_SESSION['message'] = "Échec de la confirmation du rendez-vous.";
        }

        header('Location: index.php?action=listerendezvous');
        exit;
    }
    
private function envoyerEmailConfirmation($rendezvous) {
    $mailPatient = $rendezvous->getMailPatient();
    $date_rdv = $rendezvous->getDate();
    $heure_rdv = $rendezvous->getHeure()->format('H:i');
    $services = $rendezvous->getMotifNom();

    // Informations sur l'email
    $from = "Cabinet Dr. Dupont <alcantara.marie@outlook.fr>";
    $subject = "Confirmation de votre rendez-vous chez Dr. Dupont";
    
    // Corps du message en texte brut
    $message_text = "Bonjour,\n\nVotre rendez-vous a été confirmé.\n\nRésumé de votre rendez-vous :\n";
    $message_text .= "Date : " . $date_rdv . "\n";
    $message_text .= "Heure : " . $heure_rdv . "\n";
    $message_text .= "Service : " . $services . "\n\nMerci de votre confiance.\n\nCordialement,\nL'équipe Dr. Dupont";

    // Corps du message en HTML
    $message_html = "
    <!doctype html>
    <html>
      <head>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
      </head>
      <body>
        <h1>Confirmation de votre rendez-vous</h1>
        <p>Bonjour,</p>
        <p>Votre rendez-vous a été confirmé.</p>
        <h3>Résumé de votre rendez-vous :</h3>
        <ul>
          <li><strong>Date :</strong> " . $date_rdv . "</li>
          <li><strong>Heure :</strong> " . $heure_rdv . "</li>
          <li><strong>Service :</strong> " . $services . "</li>
        </ul>
        <p>Merci de votre confiance.</p>
        <p>Cordialement,<br>L'équipe Dr. Dupont</p>
      </body>
    </html>";

    // Paramètres de connexion SMTP
    $smtp_server = "smtp://sandbox.smtp.mailtrap.io:2525";
    $smtp_user = "77b0d89431370b";  // Utilisateur Mailtrap
    $smtp_password = "07d9149997c88f";  // Mot de passe Mailtrap

    // Définition du "From" et du destinataire
    $from = "Cabinet Dr. Dupont <alcantara.marie@outlook.fr>";
    $mailPatient = $rendezvous->getMailPatient();

    // En-têtes
    $headers = [
        "From: \"$from\"",
        "To: $mailPatient",  // C'est une chaîne ici, c'est bon
        "Subject: Confirmation de votre rendez-vous chez Dr. Dupont",
        "Content-Type: multipart/alternative; boundary=\"boundary-string\""
    ];

    // Corps de l'email en texte brut et HTML
    $body = "--boundary-string\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";
    $body .= "Votre rendez-vous est confirmé...\r\n\r\n"; // Exemple de contenu textuel

    $body .= "--boundary-string\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: quoted-printable\r\n\r\n";
    $body .= "<html><body>Votre rendez-vous est confirmé...</body></html>"; // Exemple de contenu HTML

    $body .= "--boundary-string--";

    // Initialisation de cURL pour l'envoi de l'email
  $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $smtp_server);
curl_setopt($ch, CURLOPT_USERPWD, "$smtp_user:$smtp_password");
curl_setopt($ch, CURLOPT_MAIL_FROM, "alcantara.marie@outlook.fr");
curl_setopt($ch, CURLOPT_MAIL_RCPT, array($mailPatient));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Exécution de la requête cURL
$response = curl_exec($ch);

// Si tu veux afficher la réponse ou l'erreur plus tard
if (curl_errno($ch)) {
    // Log ou gestion des erreurs ici
    error_log('Erreur cURL : ' . curl_error($ch));  // Par exemple dans un fichier log
} else {
    // Log ou gestion de la réponse ici si besoin
    error_log('Réponse : ' . $response);  // Log dans un fichier par exemple
}

curl_close($ch);
}
    
    
}

