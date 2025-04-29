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
                header('Location: /test/projet_php/index.php?action=inscription');
                exit;
            }    
            // hashage du mot de passe et enregistrement de l'utilisateur
            $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);    
            $utilisateurManager = new UtilisateurManager();
    
            try {
                $utilisateurManager->ajouterUtilisateur($nom, $prenom, $mail, $motDePasseHash, $telephone);
                $_SESSION['message'] = "Inscription réussie, vous pouvez vous connecter maintenant.";
                header('Location: /test/projet_php/index.php?action=connexion');
                exit;
            } catch (PDOException $e) {
                $_SESSION['errors'] = ["Erreur lors de l'enregistrement : " . $e->getMessage()];
                header('Location: /test/projet_php/index.php?action=inscription');
                exit;
            }
        }else {
            $views = new Views();
            $params = ['errors' => $_SESSION['errors'] ?? []];
            $views->render("inscription", $params);
            unset($_SESSION['errors']); // Effacer les erreurs après les avoir affichées
        }
        
    }

    public function showConnexion(){
        if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] != 1) {
            header('Location: /test/projet_php/index.php?action=profil');
            exit;
        }else if (isset($_SESSION['user'])&& $_SESSION['user']['isAdmin'] == 1) {
            header('Location: /test/projet_php/index.php?action=profilAdmin');
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
                header('Location: /test/projet_php/index.php?action=connexion');
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
                    header('Location: /test/projet_php/index.php?action=profiladmin');
                } else {
                    header('Location: /test/projet_php/index.php?action=profil');
                }
                exit;
            } else {
                $_SESSION['errors'] = ["Email ou mot de passe incorrect."];
                header('Location: /test/projet_php/index.php?action=connexion');
                exit;
            }
        }
            
    }

   

}