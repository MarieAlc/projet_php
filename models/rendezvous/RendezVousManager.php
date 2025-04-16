<?php

include_once 'models/AbstractEntityManager.php';

class RendezVousManager extends AbstractEntityManager {
    public function getListeRendezVous() {
        $sql = "SELECT * FROM rendezvous";
        $statement = $this->db->query($sql);

        $listeRendezVous = [];
        while ($rendezvous = $statement->fetch()) {
            $listeRendezVous[] = new RendezVous($rendezvous);            
        }
        return $listeRendezVous;
    }

    public function ajouterRendezVous(RendezVous $rdv) {
        $sql = "INSERT INTO rendezvous (date, heure, motif, idClient, mailPatient)
                VALUES (:date, :heure, :motif, :idClient, :mailPatient)";
        $statement = $this->db->prepare($sql);
    
        $statement->execute([
            'date' => $rdv->getDate(),
            'heure' => $rdv->getHeure()->format('H:i:s'), 
            'motif' => $rdv->getMotif(),
            'idClient' => $rdv->getIdClient(),
            'mailPatient' => $rdv->getMailPatient()
        ]);
    }
}