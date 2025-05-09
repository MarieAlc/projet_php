<?php
include_once __DIR__ . '/../AbstractEntityManager.php';

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

    public function modifierActualite($id, $titre, $contenu, $photo = null) {
        $sql = "UPDATE actualites SET titre = :titre, contenu = :contenu";
        

        if ($photo !== null) {
            $sql .= ", photo = :photo";
        }
    
        $sql .= " WHERE id = :id";
    
        $statement = $this->db->prepare($sql);
        
        $params = [
            'id' => $id,
            'titre' => $titre,
            'contenu' => $contenu,
        ];
    

        if ($photo !== null) {
            $params['photo'] = $photo;
        }
    
        $statement->execute($params);
    }
    

    public function supprimerActualite($id) {
        $statement = $this->db->prepare("DELETE FROM actualites WHERE id = :id");
        $statement->execute([
            'id' => $id
        ]);
    }

    public function ajouterActualite($titre, $contenu, $photoPath = null) {
        $statement = $this->db->prepare("INSERT INTO actualites (titre, contenu, date, photo) VALUES (:titre, :contenu, NOW(), :photo)");
        $statement->execute([
            'titre' => $titre,
            'contenu' => $contenu,
            'photo' => $photoPath
        ]);
    }


}