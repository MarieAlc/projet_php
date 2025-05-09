<?php
require_once '/homepages/9/d4298990792/htdocs/siteweb/private/models/AbstractEntityManager.php';




class ServiceManager extends AbstractEntityManager {

    public function getListeServices(){
        $sql = "SELECT * FROM service";
        $statement = $this->db->query($sql);

        $listeServices= [];
        while ($service = $statement->fetch()) {
            $listeServices[] = new Service($service);            
        }
        return $listeServices;
    }
    
    public function getService($id){
        $statement = $this->db->prepare("SELECT * FROM service WHERE id = :id");
        $statement->execute([
            'id' => $id
        ]);
        $service = $statement->fetch();

        return $service ? new Service($service) : null;

    
    }

  

    public function ajouterService() {
        if (empty($_POST['nom']) || empty($_POST['description']) || empty($_POST['prix'])) {
            throw new Exception('Tous les champs sont obligatoires.');
        }
    
        if (!is_numeric($_POST['prix']) || $_POST['prix'] <= 0) {
            throw new Exception('Le prix doit être un nombre positif.');
        }
    
        $statement = $this->db->prepare("INSERT INTO service (nom, description, prix) VALUES (:nom, :description, :prix)");
        $statement->execute([
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'prix' => $_POST['prix']
        ]);
    }

    public function supprimerService($id){
        $statement = $this->db->prepare("DELETE FROM service WHERE id = :id");
        $statement->execute([
            'id' => $id
        ]);
    }
    public function modifierService($id, $nom, $description, $prix) {
        $sql = "UPDATE service SET nom = :nom, description = :description, prix = :prix WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'id' => $id
        ]);
    }
}