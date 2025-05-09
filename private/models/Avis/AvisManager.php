<?php
include_once __DIR__ . '/../AbstractEntityManager.php';
include_once 'Avis.php';

class AvisManager extends AbstractEntityManager {

    public function ajouterAvis(Avis $avis) {
        $sql = "INSERT INTO avis (nomPatient, note, commentaire, photo) VALUES (?, ?, ?, ?)";
        
       
        $photo = $avis->getPhoto() ? $avis->getPhoto() : null;
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $avis->getNomPatient(),
            $avis->getNote(),
            $avis->getCommentaire(),
            $photo
        ]);
    }

    public function getAllAvis() {
        $sql = "SELECT * FROM avis ORDER BY dateAvis DESC";
        $stmt = $this->db->query($sql);
        $avisList = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $avis = new Avis();
            $avis->setId($row['id']);
            $avis->setNomPatient($row['nomPatient']);
            $avis->setNote($row['note']);
            $avis->setCommentaire($row['commentaire']);
            $avis->setPhoto($row['photo']);
            $avis->setDateAvis($row['dateAvis']);

            $avisList[] = $avis;
        }
        return $avisList;
    }
    public function getAvisParId($id) {
        $sql = "SELECT * FROM avis WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $avis = new Avis();
            $avis->setId($row['id']);
            $avis->setNomPatient($row['nomPatient']);
            $avis->setNote($row['note']);
            $avis->setCommentaire($row['commentaire']);
            $avis->setPhoto($row['photo']);
            $avis->setDateAvis($row['dateAvis']);

            return $avis;
        }
        return null;
    }

    public function getMoyenneNote(){
        $sql = "SELECT AVG(note) as moyenne FROM avis";
        $stmt = $this->db->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return round($row['moyenne'], 1);
        }
        return null;
    }
}



