<?php
include_once 'models/AbstractEntityManager.php';

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

}
