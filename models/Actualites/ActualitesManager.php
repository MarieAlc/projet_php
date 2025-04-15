<?php
include_once 'models/AbstractEntityManager.php';

class ActualitesManager extends AbstractEntityManager {

    public function getListeActualites(){
        $sql = "SELECT * FROM actualites";
        $statement = $this->db->query($sql);

        $listeActualites= [];
        while ($actualite = $statement->fetch()) {
            $listeActualites[] = new Actualite($actualite);            
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
            return new actualite($actualite);
        }
        return null;

    
    }
}