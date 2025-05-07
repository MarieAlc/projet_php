<?php
include_once __DIR__ . '/../AbstractEntityManager.php';

class AproposManager extends AbstractEntityManager {

    public function listeApropos() {
        $sql = "SELECT * FROM apropos";
        $statement = $this->db->query($sql);

        $apropos = [];
        while ($aproposData = $statement->fetch()) {
            $apropos[] = new Apropos($aproposData);
        }

        return $apropos;

    }
    public function getAproposById($id) {
        $sql = "SELECT * FROM apropos WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
    
        $aproposData = $statement->fetch();
        return new Apropos($aproposData);
    }

    public function modifierApropos($id, $titre, $texte) {
        $sql = "UPDATE apropos SET titre = :titre, texte = :texte WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':titre', $titre);
        $statement->bindValue(':texte', $texte);

        return $statement->execute();
    }
    public function supprimerApropos($id) {
        $sql = "DELETE FROM apropos WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $id);
    
        return $statement->execute();
    }
    public function ajouterApropos($titre, $texte) {
        $sql = "INSERT INTO apropos (titre, texte) VALUES (:titre, :texte)";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':titre', $titre);
        $statement->bindValue(':texte', $texte);
    
        return $statement->execute();
    }

}