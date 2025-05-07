<?php
include_once __DIR__ . '/../init.php';


class ControllerUtilisateur extends Controller{



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


 
   
    
}
