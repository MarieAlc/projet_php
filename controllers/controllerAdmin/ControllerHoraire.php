<?php
class ControllerHoraire extends Controller {

    public function modifierHoraire() {
        $horaireManager = new HoraireManager($this->db);
        $horaires = $horaireManager->getListeHoraires(); 
    
        if (isset($_POST['submit'])) {
           
            foreach ($horaires as $horaire) {
                $id = $horaire->getId();
                
                $heure_debut = new DateTime($_POST['ouverture'][$horaire->getId()]);
                $heure_fin = new DateTime($_POST['fermeture'][$horaire->getId()]);

                $estOuvert = !isset($_POST['ferme'][$id]);
    
                
                $horaire->setHeure_debut($heure_debut);
                $horaire->setHeure_fin($heure_fin);
                $horaire->setOuvert($estOuvert);
    
              
                $horaireManager->modifierHoraire($horaire);
            }
    
            
            $_SESSION['message'] = "Les horaires ont été modifiés avec succès!";
          
            header('Location: index.php?action=modifierhoraire');
            exit; 
        }
    
               $views = new Views();
        $views->render('admin/modifierhoraire', ['horaires' => $horaires]);
    }
        
    

}