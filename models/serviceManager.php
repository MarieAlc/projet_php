<?php
include_once 'models/abstractEntityManager.php';

class serviceManager extends abstractEntityManager {

    public function getListeServices(){
        $sql = "SELECT * FROM service";
        $statement = $this->db->query($sql);

        $listeServices= [];
        while ($service = $statement->fetch()) {
            $listeServices[] = new service($service);            
        }
        return $listeServices;
    }
    
    public function getService($id){
        $statement = $this->db->prepare("SELECT * FROM service WHERE id = :id");
        $statement->execute([
            'id' => $id
        ]);
        $service = $statement->fetch();
        if($service){
            return new service($service);
        }
        return null;

    
    }
}