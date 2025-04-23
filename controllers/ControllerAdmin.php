<?php

class ControllerAdmin extends Controller {

    public function showListeUtilisateurs() {
        $this->verifierAdmin();
        $utilisateurManager = new UtilisateurManager();
    
        // Récupérer la liste des utilisateurs
        $utilisateurs = $utilisateurManager->listeUtilisateurs();
        $views = new Views();
        $views->render('listeutilisateurs', ['utilisateurs' => $utilisateurs]);
    }
    
    public function modifierRoleUtilisateur() {
        $this->verifierAdmin();
        // Si la requête est en POST, on met à jour le rôle de l'utilisateur
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['userId'];
            $newRole = $_POST['newRole'];
            $utilisateurManager = new UtilisateurManager();

            try {
                // Mettre à jour le rôle de l'utilisateur dans la base de données
                $utilisateurManager->modifierRoleUtilisateur($userId, $newRole);
                $_SESSION['message'] = "Le rôle de l'utilisateur a été mis à jour avec succès.";
            } catch (Exception $e) {
                $_SESSION['errors'] = [$e->getMessage()];
            }

            // Récupérer à nouveau la liste des utilisateurs et afficher la vue
            $this->renderListeUtilisateurs();
        }
    }
    // Méthode pour afficher la liste des utilisateurs avec les messages
    private function renderListeUtilisateurs() {
        $utilisateurManager = new UtilisateurManager();
        $utilisateurs = $utilisateurManager->listeUtilisateurs();
        $views = new Views();
        $views->render('listeutilisateurs', [
            'utilisateurs' => $utilisateurs,
            'message' => $_SESSION['message'] ?? null,
            'errors' => $_SESSION['errors'] ?? []
        ]);
        // Nettoyer les messages après affichage
        unset($_SESSION['message'], $_SESSION['errors']);
    }

    public function showListeRendezVous() {
        $this->verifierAdmin();
        $rendezvousManager = new RendezVousManager();
    
        // Récupérer la liste des rendez-vous
        $rendezvous = $rendezvousManager->listeRendezVous();
        $views = new Views();
        $views->render('listerendezvous', ['rendezvous' => $rendezvous]);
    }

   
}

