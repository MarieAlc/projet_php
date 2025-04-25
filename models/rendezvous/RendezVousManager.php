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
    
        $row = $statement->fetch();
    
        if ($row) {
            $serviceManager = new ServiceManager();
            $service = $serviceManager->getService($row['motif']); 
            $motifNom = $service ? $service->getNom() : ''; 
    
            $rendezvous = new RendezVous();
            $rendezvous->setId($row['id']);
            $rendezvous->setDate($row['date']);
            $rendezvous->setHeure(new DateTime($row['heure']));
            $rendezvous->setMotif($row['motif']);
            $rendezvous->setMotifNom($motifNom); 
            $rendezvous->setIdClient($row['idClient']);
            $rendezvous->setMailPatient($row['mailPatient']);
    
            return $rendezvous;
        }
    
        return null;
    
    
    }
    public function getRendezVousParUtilisateur($idClient) {
        $query = "SELECT * FROM rendezvous WHERE idClient = :clientId";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':clientId', $idClient, PDO::PARAM_INT);
        $statement->execute();
    

        $rdvs = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $rdv = new RendezVous();
            $rdv->setId($row['id']);
            $rdv->setDate($row['date']);
            $rdv->setHeure(new DateTime($row['heure']));
            $rdv->setMotif($row['motif']);
            $rdv->setMailPatient($row['mailPatient']);

            $serviceManager = new ServiceManager();
            $service = $serviceManager->getService($row['motif']);
    
           
            if ($service) {
                $motifNom = $service->getNom();
            } else {
                $motifNom = 'Service non défini'; 
            }
    
            
            $rdv->setMotifNom($motifNom);
    
            $rdvs[] = $rdv;
        }
        return $rdvs;
    }

}