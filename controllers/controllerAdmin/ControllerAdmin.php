<?php

class ControllerAdmin extends Controller {

    public function showListeUtilisateurs() {
        $this->verifierAdmin();
        $utilisateurManager = new UtilisateurManager();
        
        $utilisateur = $utilisateurManager->listeUtilisateurs();
    
        $message = $_SESSION['message'] ?? null;
        $errors = $_SESSION['errors'] ?? [];
        unset($_SESSION['message'], $_SESSION['errors']);
    
        $views = new Views();
        $views->render('admin/listeutilisateurs', [
            'utilisateurs' => $utilisateur,
            'message' => $message,
            'errors' => $errors
        ]);
    }

    public function modifierRoleUtilisateur() {
        $this->verifierAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['userId'];
            $newRole = $_POST['newRole'];
            $utilisateurManager = new UtilisateurManager();

            try {
                
                $utilisateurManager->modifierRoleUtilisateur($userId, $newRole);
                $_SESSION['message'] = "Le rôle de l'utilisateur a été mis à jour avec succès.";
            } catch (Exception $e) {
                $_SESSION['errors'] = [$e->getMessage()];
            }

            $this->renderListeUtilisateurs();
        }
    }

    public function modifierUtilisateur() {
        $this->verifierAdmin();
        $utilisateurManager = new UtilisateurManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['userId'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $telephone = $_POST['telephone'];
    
            try {
                $utilisateurManager->modifierUtilisateur($userId, $nom, $prenom, $mail, $telephone);
                $_SESSION['message'] = "L'utilisateur a bien été modifié.";
                header('Location: index.php?action=listeutilisateurs');
                exit;
            } catch (Exception $e) {
                $_SESSION['errors'] = [$e->getMessage()];
                header("Location: index.php?action=modifierutilisateur&id=$userId");
                exit;
            }
        }
    
        if (isset($_GET['id'])) {
            $userId = $_GET['id'];
            $utilisateur = $utilisateurManager->getUtilisateurById($userId);
    
            $views = new Views();
            $views->render('admin/modifierutilisateur', [
                'utilisateur' => [
                    'id' => $utilisateur->getId(),
                    'nom' => $utilisateur->getNom(),
                    'prenom' => $utilisateur->getPrenom(),
                    'mail' => $utilisateur->getMail(),
                    'telephone' => $utilisateur->getTelephone()
                ]
            ]);
        }
    }

    public function ajouterUtilisateur(){
        $this->verifierAdmin();
        $utilisateurManager = new UtilisateurManager();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $motDePasse = $_POST['motdepasse'];
            $telephone = $_POST['telephone'];
            $role = $_POST['role'];
    
            try {               
                if (!$utilisateurManager->isEmailUnique($mail)) {
                    throw new Exception('L\'email est déjà utilisé.');
                }
    
                $utilisateurManager->ajouterUtilisateur($nom, $prenom, $mail, password_hash($motDePasse, PASSWORD_BCRYPT), $telephone, $role);
                $_SESSION['message'] = "L'utilisateur a été ajouté avec succès.";
                header('Location: index.php?action=listeutilisateurs');
                exit;
            } catch (Exception $e) {
                $_SESSION['errors'] = [$e->getMessage()];
                header('Location: index.php?action=listeutilisateurs');
                exit;
            }
        }
    }

    public function supprimerUtilisateur(){
        $this->verifierAdmin();
        $utilisateurManager = new UtilisateurManager();
        
        if (isset($_GET['id'])) {
            $userId = $_GET['id'];

            if (!$utilisateurManager->peutSupprimerUtilisateur($userId)) {
                $_SESSION['errors'][] = "Impossible de supprimer cet utilisateur : des rendez-vous sont associés.";
                header('Location: index.php?action=listeutilisateurs');
                exit;
            }
    
            try {
                $utilisateurManager->supprimerUtilisateur($userId);
                $_SESSION['message'] = "L'utilisateur a été supprimé avec succès.";
            } catch (Exception $e) {
                $_SESSION['errors'] = [$e->getMessage()];
            }
        }
        
        header('Location: index.php?action=listeutilisateurs');
        exit;
    }

    
    public function showListeRendezVous() {
        $this->verifierAdmin();
        $rendezvousManager = new RendezVousManager();
        
        // Récupérer la liste des rendez-vous
        $rendezvous = $rendezvousManager->listeRendezVous();
        $views = new Views();
        $views->render('admin/listerendezvous', ['rendezvous' => $rendezvous]);
    }
    
    private function renderListeUtilisateurs() {
        $utilisateurManager = new UtilisateurManager();
        $utilisateurs = $utilisateurManager->listeUtilisateurs();
        $views = new Views();
        $views->render('admin/listeutilisateurs', [
            'utilisateurs' => $utilisateurs,
            'message' => $_SESSION['message'] ?? null,
            'errors' => $_SESSION['errors'] ?? []
        ]);
        // Nettoyer les messages après affichage
        unset($_SESSION['message'], $_SESSION['errors']);
    }



        
    



   
}

