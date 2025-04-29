<?php
class ControllerActualite extends Controller {

    public function showActualitesAdmin() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $actualiteManager = new ActualitesManager();
            $actualite = $actualiteManager->getActualite($id);
    
            $views = new Views();
            $views->render("admin/actualiteadmin", [
                'actualite' => $actualite
            ]);
        } else {
            $actualiteManager = new ActualitesManager();
            $listeActualites = $actualiteManager->getListeActualites();
    
            $views = new Views();
            $views->render("admin/actualiteadmin", [
                'listeActualites' => $listeActualites
            ]);
        }
    }

    public function modifierActualite() {
        if (isset($_POST['id']) && isset($_POST['titre']) && isset($_POST['contenu'])) {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            
          
            $actualiteManager = new ActualitesManager();
            $actualiteManager->modifierActualite($id, $titre, $contenu);
            
            $_SESSION['message'] = "L'actualité a été modifiée avec succès!";
            header('Location: index.php?action=actualiteadmin');
            exit;
        }
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $actualiteManager = new ActualitesManager();
            $actualite = $actualiteManager->getActualite($id);
    
          
            $titre = $actualite->getTitre();
            $contenu = $actualite->getContenu();
            $views = new Views();
            $views->render("admin/actualiteModifier", [
                'titre' => $titre,
                'contenu' => $contenu,
                'id' => $id
            ]);
        }
    }

    public function supprimerActualite() {
        $this->verifierAdmin();

        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $actualiteManager = new ActualitesManager();
            $actualiteManager->supprimerActualite($id);

            $_SESSION['message'] = "Actualité supprimée avec succès.";
        }else {
            $_SESSION['message'] = "Erreur : ID non fourni.";
        }
        header('Location: index.php?action=actualiteadmin');
        exit;
    }

    public function ajouterActualite() {
        if (isset($_POST['titre'], $_POST['contenu'])) {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $date = new DateTime(); 
    
            $actualiteManager = new ActualitesManager();
            $actualiteManager->ajouterActualite($titre, $contenu, $date);
    
            $_SESSION['message'] = "Actualité ajoutée avec succès.";
            header('Location: index.php?action=actualiteadmin');
            exit;
        }
    }
}



    