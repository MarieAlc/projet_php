<?php
include_once 'init.php';

class ControllerUtilisateur extends Controller{

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


    public function modifierRendezVousUtilisateur() {
        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];
            $rdvId = $_GET['id'];
    
    
            $rendezvousManager = new RendezVousManager();
            $rdv = $rendezvousManager->getRendezVousParId($rdvId);
    
            if ($rdv && $rdv->getIdClient() === $userId) {
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $date = $_POST['date'];
                    $heure = $_POST['heure'];
                    $motif = $_POST['motif'];
                    $mailPatient = $_POST['mailPatient'];
    
                    
                    $rendezvousManager->modifierRendezVous($rdvId, $date, $heure, $motif, $mailPatient);
    
                    $_SESSION['message'] = "Rendez-vous modifié avec succès.";
                    header('Location: /test/projet_php/index.php?action=afficherRendezVousUtilisateur');
                    exit;
                }
    
                $serviceManager = new ServiceManager();
                $services = $serviceManager->getAllServices();
    
                $views = new Views();
                $views->render('modifierrendezvousutilisateur', [
                    'rdv' => $rdv,
                    'services' => $services
                ]);
            } else {
                
                $_SESSION['errors'] = ["Rendez-vous introuvable ou non autorisé."];
                header('Location: /test/projet_php/index.php?action=afficherRendezVousUtilisateur');
                exit;
            }
        } else {
            
            header('Location: /test/projet_php/index.php?action=connexion');
            exit;
        }
    }
    public function supprimerRendezVousUtilisateur() {
        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];
            $rdvId = $_GET['id'];
    
            // Vérifier que le rendez-vous appartient bien à l'utilisateur
            $rendezvousManager = new RendezVousManager();
            $rdv = $rendezvousManager->getRendezVousParId($rdvId);
    
            if ($rdv && $rdv->getIdClient() === $userId) {
                // Supprimer le rendez-vous
                $rendezvousManager->supprimerRendezVous($rdvId);
    
                $_SESSION['message'] = "Rendez-vous supprimé avec succès.";
            } else {
                $_SESSION['errors'] = ["Rendez-vous introuvable ou non autorisé."];
            }
    
            //header('Location: /test/projet_php/index.php?action=afficherRendezVousUtilisateur');
            exit;
        } else {
            header('Location: /test/projet_php/index.php?action=connexion');
            exit;
        }
    }
    
   
    
}
