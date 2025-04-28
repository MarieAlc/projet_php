<?php
class ControllerHoraire extends Controller {

    public function modifierHoraire() {
        $horaireManager = new HoraireManager($this->db);
        $horaires = $horaireManager->getListeHoraires(); 
    
        if (isset($_POST['submit'])) {
           
            foreach ($horaires as $horaire) {
                
                $heure_debut = new DateTime($_POST['ouverture'][$horaire->getId()]);
                $heure_fin = new DateTime($_POST['fermeture'][$horaire->getId()]);
    
                
                $horaire->setHeure_debut($heure_debut);
                $horaire->setHeure_fin($heure_fin);
    
              
                $horaireManager->modifierHoraire($horaire);
            }
    
            
            $_SESSION['message'] = "Les horaires ont été modifiés avec succès!";
          
            header('Location: index.php?action=modifierhoraire');
            exit; 
        }
    
               $views = new Views();
        $views->render('modifierhoraire', ['horaires' => $horaires]);
    }
        
    

}