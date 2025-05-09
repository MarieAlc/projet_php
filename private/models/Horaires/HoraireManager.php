<?php
require_once '/homepages/9/d4298990792/htdocs/siteweb/private/models/AbstractEntityManager.php';

class HoraireManager extends AbstractEntityManager {
    
    public function getListeHoraires() {
        $sql = "SELECT * FROM horaire";
        $statement = $this->db->query($sql);

        $horaires = [];
        while ($horaire = $statement->fetch()) {
            $horaire['heure_debut'] = isset($horaire['heure_debut']) ? $horaire['heure_debut'] : '';
            $horaire['heure_fin'] = isset($horaire['heure_fin']) ? $horaire['heure_fin'] : '';
            $horaires[] = new Horaire($horaire);
        }

        return $horaires;
    }

    public function modifierHoraire($horaire) {
       
        $heure_debut = $horaire->getHeure_debut()->format('Y-m-d H:i:s');
        $heure_fin = $horaire->getHeure_fin()->format('Y-m-d H:i:s');
        $ouvert = $horaire->getOuvert() ? 1 : 0;
    
        $sql = "UPDATE horaire SET heure_debut = :heure_debut, heure_fin = :heure_fin, ouvert = :ouvert WHERE id = :id"; 
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $horaire->getId()); 
        $statement->bindValue(':heure_debut', $heure_debut);
        $statement->bindValue(':heure_fin', $heure_fin);
        $statement->bindValue(':ouvert', $ouvert, PDO::PARAM_INT);
        
        return $statement->execute();
    }
    

}
