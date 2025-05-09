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
        $views->render('utilisateur/profil', ['user' => $user,'rendezvousList' => $rendezvousList]);
    }

    public function showProfilAdmin(){ 
        $this->verifierConnexion();
        $user = $_SESSION['user'];
        
        if ($_SESSION['user']['isAdmin'] != 1) {
            header('Location: index.php?action=profil');
            exit;
        }

        $rendezVousManager = new RendezVousManager();
        $serviceManager = new ServiceManager();
        $utilisateurManager = new UtilisateurManager();

        $rendezvousList = $rendezVousManager->getListeRendezVous();
        $utilisateurs = $utilisateurManager->listeUtilisateurs();

        foreach ($rendezvousList as $rdv) {
            $service = $serviceManager->getService($rdv->getMotif());
            $rdv->nomService = $service ? $service->getNom() : 'Inconnu';
        }
        $patients = array_filter($utilisateurs, function($utilisateur) {
            return $utilisateur->getIsAdmin() === false;
        });
        $nombrePatients = count($patients);

        $views = new Views();
        $views->render('admin/profiladmin', [
            'user' => $user,
            'rendezvousList' => $rendezvousList,
            'nombrePatients' => $nombrePatients
        ]);
    }
    
    public function deconnexion(){

        session_destroy();
        header('Location: /test/projet_php/index.php?action=accueil');
        exit;
    }
    public function showInscription(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer et valider les données
            $postData = $_POST;
            $errors = [];     
            $nom = trim($postData['nom'] ?? '');
            $prenom = trim($postData['prenom'] ?? '');
            $mail = trim($postData['mail'] ?? '');
            $telephone = trim($postData['telephone'] ?? '');
            $motDePasse = $postData['motDePasse'] ?? '';
    
            // Validation des données
            if (empty($nom) || empty($prenom) || empty($mail) || empty($telephone) || empty($motDePasse)) {
                $errors[] = "Tous les champs sont obligatoires.";
            }    
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Adresse email invalide.";
            }    
            if (preg_match('/\d/', $nom)) {
                $errors[] = "Le nom ne doit pas contenir de chiffres.";
            }    
            if (preg_match('/\d/', $prenom)) {
                $errors[] = "Le prénom ne doit pas contenir de chiffres.";
            }    
            if (
                !preg_match('/[A-Z]/', $motDePasse) ||
                !preg_match('/[a-z]/', $motDePasse) ||
                !preg_match('/\d/', $motDePasse)
            ) {
                $errors[] = "Le mot de passe doit contenir une majuscule, une minuscule et un chiffre.";
            }   
            // Si des erreurs existent les stocker en session et rediriger vers la page d'inscription
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: index.php?action=inscription');
                exit;
            }    
            // hashage du mot de passe et enregistrement de l'utilisateur
            $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);    
            $utilisateurManager = new UtilisateurManager();
    
            try {
                $role = 0; // 0 pour utilisateur normal
                $utilisateurManager->ajouterUtilisateur($nom, $prenom, $mail, $motDePasseHash, $telephone,$role);
                $_SESSION['message'] = "Inscription réussie, vous pouvez vous connecter maintenant.";
                header('Location: index.php?action=connexion');
                exit;
            } catch (PDOException $e) {
                $_SESSION['errors'] = ["Erreur lors de l'enregistrement : " . $e->getMessage()];
                header('Location: index.php?action=inscription');
                exit;
            }
        }else {
            $views = new Views();
            $params = ['errors' => $_SESSION['errors'] ?? [], 'message' => $_SESSION['message'] ?? ''];
            $views->render("inscription", $params);
            unset($_SESSION['errors']);
            unset($_SESSION['message']);
        }
        
    }

    public function showConnexion(){
        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] != 1) {
            header('Location: index.php?action=profil');
            exit;
        }else if (isset($_SESSION['user'])&& $_SESSION['user']['isAdmin'] == 1) {
            header('Location: index.php?action=profilAdmin');
            exit;
        }
    
        $views = new Views();
        $views->render('connexion', []);
    }

    public function verifConnexion(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mail = trim($_POST['mail'] ?? '');
            $motDePasse = $_POST['motDePasse'] ?? '';
    
            // Validation des données
            if (empty($mail) || empty($motDePasse)) {
                $_SESSION['errors'] = ["Email et mot de passe sont requis."];
                header('Location: index.php?action=connexion');
                exit;
            }
    
            // Vérification des informations dans la base de données
            $utilisateurManager = new UtilisateurManager();
            $utilisateur = $utilisateurManager->getUtilisateurByEmail($mail);
    
            if ($utilisateur && password_verify($motDePasse, $utilisateur['motDePasse'])) {
                $_SESSION['user'] = [
                    'id' => $utilisateur['id'],
                    'nom' => $utilisateur['nom'],
                    'prenom' => $utilisateur['prenom'],
                    'mail' => $utilisateur['mail'],
                    'telephone' => $utilisateur['telephone'],
                    'isAdmin' => $utilisateur['isAdmin']
                ];
                $_SESSION['message'] = "Vous êtes connecté ! Bienvenue sur votre profil.";
         
                if ($utilisateur['isAdmin'] === 1) {
                    header('Location: index.php?action=profiladmin');
                } else {
                    header('Location: index.php?action=profil');
                }
                exit;
            } else {
                $_SESSION['errors'] = ["Email ou mot de passe incorrect."];
                header('Location: index.php?action=connexion');
                exit;
            }
        }
            
    }

    public function showMotDePasseOublie()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mail = trim($_POST['mail'] ?? '');

        // Validation du mail
        if (empty($mail)) {
            $_SESSION['errors'] = ["Adresse mail requise."];
            header('Location: /test/projet_php/public/index.php?action=motdepasseoublie');
            exit;
        }

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'] = ["Format de l'adresse mail invalide."];
            header('Location: /test/projet_php/public/index.php?action=motdepasseoublie');
            exit;
        }

        // Vérification dans la base
        $utilisateurManager = new UtilisateurManager();
        $utilisateur = $utilisateurManager->getUtilisateurByEmail($mail);

        if ($utilisateur) {
            // Envoi d’un mail à l’admin
            $adminMail = 'alcantara.marie@outlook.fr'; 
            $sujet = "Demande de réinitialisation de mot de passe";
            $message = "Un utilisateur a demandé une réinitialisation de mot de passe :\n\n"
                     . "Nom : " . $utilisateur['nom'] . "\n"
                     . "Prénom : " . $utilisateur['prenom'] . "\n"
                     . "Email : " . $utilisateur['mail'] . "\n"
                     . "ID : " . $utilisateur['id'] . "\n";
            $headers = "From: \"Site Dr. Dupont\" <no-reply@alwaysdata.net>";

           
                     mail($adminMail, $sujet, $message, $headers);

            // Ajouter un message de succès si le fichier est généré
            $_SESSION['message'] = "Votre demande a été envoyée à l'administrateur. Vous recevrez un nouveau mot de passe prochainement.";
        } else {
            $_SESSION['errors'] = ["Aucun utilisateur trouvé avec cette adresse mail."];
        }

        header('Location: index.php?action=motdepasseoublie');
        exit;
    } else {
        // Affichage du formulaire
        $views = new Views();
        $views->render('motdepasseoublie', []);
    }
}
}

   

