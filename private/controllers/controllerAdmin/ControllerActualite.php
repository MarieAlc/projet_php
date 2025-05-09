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
              
            $photo = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photoName = uniqid() . '_' . $_FILES['photo']['name'];
                $photoPath = 'public/image/actualites/' . $photoName;
    
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
    
                
                $photo = $photoPath;
            
            }
    
          
            $actualiteManager = new ActualitesManager();
            $actualiteManager->modifierActualite($id, $titre, $contenu, $photo);
            
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
            $photo = $actualite->getPhoto(); 
    
            $views = new Views();
            $views->render("admin/actualiteModifier", [
                'titre' => $titre,
                'contenu' => $contenu,
                'photo' => $photo, 
                'id' => $id
            ]);
        }
    }
    

    public function supprimerActualite() {
        $this->verifierAdmin();
    
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
    
        
            $actualiteManager = new ActualitesManager();
            $actualite = $actualiteManager->getActualite($id);
            $photo = $actualite->getPhoto();
    
            if ($photo && file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
    
            $actualiteManager->supprimerActualite($id);
            $_SESSION['message'] = "Actualité supprimée avec succès.";
        } else {
            $_SESSION['message'] = "Erreur : ID non fourni.";
        }
    
        header('Location: index.php?action=actualiteadmin');
        exit;
    }

    public function ajouterActualite() {
        if (isset($_POST['titre'], $_POST['contenu'])) {
            $titre = $_POST['titre'];
            $contenu = $_POST['contenu'];
            $photo = null;
    
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photoName = uniqid() . '_' . $_FILES['photo']['name'];
                $photoPath = 'public/image/actualites/' . $photoName;
    
                move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
    
                
                $photo = $photoPath;
            
            }
    
            $actualiteManager = new ActualitesManager();
            try {
                $actualiteManager->ajouterActualite($titre, $contenu, $photo); 
                $_SESSION['message'] = "Actualité ajoutée avec succès.";
            } catch (Exception $e) {
                $_SESSION['message'] = "Erreur : " . $e->getMessage();
            }
    
            header('Location: index.php?action=actualiteadmin');
            exit;
        }
    }
    

}



    