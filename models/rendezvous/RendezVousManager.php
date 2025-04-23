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
    public function getRendezVousUtilisateur($idClient) {
        $sql = "SELECT * FROM rendezvous WHERE idClient = :idClient ORDER BY date DESC";
        $statement = $this->db->prepare($sql);
        $statement->execute(['idClient' => $idClient]);
    
        $rendezvousList = [];
        while ($rdv = $statement->fetch()) {
            $rendezvousList[] = new RendezVous($rdv);
        }
    
        return $rendezvousList;
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

    public function supprimerRendezVous($id) {
        $sql = "DELETE FROM rendezvous WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
    }

    public function modifierRendezVous(RendezVous $rdv) {
        $sql = "UPDATE rendezvous SET date = :date, heure = :heure, motif = :motif, idClient = :idClient, mailPatient = :mailPatient WHERE id = :id";
        $statement = $this->db->prepare($sql);
    
        $statement->execute([
            'id' => $rdv->getId(),
            'date' => $rdv->getDate(),
            'heure' => $rdv->getHeure()->format('H:i:s'), 
            'motif' => $rdv->getMotif(),
            'idClient' => $rdv->getIdClient(),
            'mailPatient' => $rdv->getMailPatient()
        ]);
    }
    public function getRendezVousParId($id) {
        $sql = "SELECT * FROM rendezvous WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
    
        $rendezvous = $statement->fetch();
    
        if ($rendezvous) {
            return new RendezVous($rendezvous); 
        }
        return null; 
    }
    

}