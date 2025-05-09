<?php
include_once __DIR__ . '/../models/Avis/AvisManager.php';




class ControllerAvis extends Controller{

    public function afficherAvis() {
        $avisManager = new AvisManager($this->db);
        $avisList = $avisManager->getAllAvis(); 
        $moyenneNote = $avisManager->getMoyenneNote();

        $views = new Views();
        $views->render('avis', ['avisList' => $avisList,
          'moyenneNote' => $moyenneNote]); 
    }
public function ajouterAvis() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $note = $_POST['note'];
            $commentaire = $_POST['commentaire'];
            $photo = isset($_FILES['photo']) ? $_FILES['photo'] : null;
            $nomPatient = $_POST['nomPatient'];
    
            $avis = new Avis();
            $avis->setNomPatient($nomPatient);
            $avis->setNote($note);
            $avis->setCommentaire($commentaire);
            $avis->setDateAvis(date('Y-m-d H:i:s'));
    
            if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
                $targetDir = "public/image/uploads/"; 
                $targetFile = $targetDir . basename($photo["name"]);
                move_uploaded_file($photo["tmp_name"], $targetFile);
                $avis->setPhoto($targetFile);
            }
    
            $avisManager = new AvisManager($this->db);
            $avisManager->ajouterAvis($avis);

            $_SESSION['message'] = "Avis ajouté avec succès.";
            header('Location:index.php?action=avis');
            exit;
        }
        $views = new Views();
        $views->render('formulaireavis',[]);
    }
    public function afficherFormulaireAvis() {
        
        $views = new Views();
        $views->render('formulaireavis',[]);
    }
    public function deposerAvis() {
       
    
        $note = $_POST['note'] ?? null;
        $commentaire = $_POST['commentaire'] ?? null;
        $photo = $_FILES['photo'] ?? null; 
    
        if ($note < 1 || $note > 5 || empty($commentaire)) {
            $_SESSION['message'] = "Note et commentaire sont obligatoires.";
            header('Location: index.php?action=formulaireavis');
            exit;
        }
        $avis = new Avis();
        $avis->setNomPatient($_SESSION['user_name']);
        $avis->setNote($note);
        $avis->setCommentaire($commentaire);
        $avis->setDateAvis(date('Y-m-d H:i:s'));
            
        
        if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
           
            $targetDir = "public/image/uploads/"; 
            $targetFile = $targetDir . basename($photo["name"]);
            move_uploaded_file($photo["tmp_name"], $targetFile);
            $avis->setPhoto($targetFile);
        }
    
        $avisManager = new AvisManager($this->db);
        $avisManager->saveAvis($avis);
    
        $_SESSION['message'] = "Avis déposé avec succès.";
        header('Location: index.php?action=avis');
        exit;
    }
}