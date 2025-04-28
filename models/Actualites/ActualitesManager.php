<?php
include_once 'models/AbstractEntityManager.php';

class ActualitesManager extends AbstractEntityManager {

    public function getListeActualites(){
        $sql = "SELECT * FROM actualites";
        $statement = $this->db->query($sql);

        $listeActualites= [];
        if($statement){
            while ($actualite = $statement->fetch()) {
                $listeActualites[] = new Actualite($actualite);            
            }
        }
        return $listeActualites;
    }
    
    public function getActualite($id){
        $statement = $this->db->prepare("SELECT * FROM actualites WHERE id = :id");
        $statement->execute([
            'id' => $id
        ]);
        $actualite = $statement->fetch();
        if($actualite){
            return new Actualite($actualite);
        }
        return null;

    
    }

    public function modifierActualite($id, $titre, $contenu) {
        $statement = $this->db->prepare("UPDATE actualites SET titre = :titre, contenu = :contenu WHERE id = :id");
        $statement->execute([
            'id' => $id,
            'titre' => $titre,
            'contenu' => $contenu
        ]);
    }

    public function supprimerActualite($id) {
        $statement = $this->db->prepare("DELETE FROM actualites WHERE id = :id");
        $statement->execute([
            'id' => $id
        ]);
    }

    public function ajouterActualite($titre, $contenu) {
        $statement = $this->db->prepare("INSERT INTO actualites (titre, contenu, date) VALUES (:titre, :contenu, NOW())");
        $statement->execute([
            'titre' => $titre,
            'contenu' => $contenu
        ]);
    }


}