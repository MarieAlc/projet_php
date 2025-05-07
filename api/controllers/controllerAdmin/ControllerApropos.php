<?php
class ControllerApropos extends Controller{
    public function aproposAdmin() {
        
        $aproposManager = new AproposManager();
        $apropos = $aproposManager->listeApropos();
    
      
        $views = new Views();
        $views->render("admin/aproposadmin", [
            'apropos' => $apropos
        ]);
    }
    public function modifierApropos() {
        if (isset($_POST['titre']) && isset($_POST['texte']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $titre = $_POST['titre'];
            $texte = $_POST['texte'];

    
            $aproposManager = new AproposManager();
            $aproposManager->modifierApropos($id, $titre, $texte);
   
            $_SESSION['message'] = "La section 'À propos' a été modifiée avec succès!";
            header('Location: index.php?action=aproposadmin');
            exit;
        }
  
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $aproposManager = new AproposManager();
            $apropos = $aproposManager->getAproposById($id);
    
            $views = new Views();
            $views->render("admin/modifierapropos", [
                'id' => $id,
                'aproposTitre' => $apropos->getTitre(),
                'aproposTexte' => $apropos->getTexte()
            ]);
        }
    }
    public function supprimerApropos() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            
           
            $aproposManager = new AproposManager();
            $aproposManager->supprimerApropos($id);
  
            $_SESSION['message'] = "La section À propos a été supprimée avec succès!";
            header('Location: index.php?action=aproposadmin');
            exit;
        }
    }
    public function ajouterApropos() {
        if (isset($_POST['titre']) && isset($_POST['texte'])) {
            $titre = $_POST['titre'];
            $texte = $_POST['texte'];
            
            $aproposManager = new AproposManager();
            $aproposManager->ajouterApropos($titre, $texte);
            
            $_SESSION['message'] = "L'élément 'À propos' a été ajouté avec succès!";
            header('Location: index.php?action=aproposadmin');
            exit;
        }
    }
    

}