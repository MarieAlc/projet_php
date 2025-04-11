<?php

class model {

    private $db;
    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME .';charset=utf8', DB_USER, DB_PASS);

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    function getListeServices(){
        $request = "SELECT * FROM service";
        $statement = $this->db->query($request);

        $listeServices= [];

        while ( $service = $statement->fetch()) {
            $listeServices[] =$service;            
        }
        return $listeServices;
    }
    
    function getService($id){
        $request = "SELECT * FROM service WHERE id = :id";
        $statement = $this->db->prepare($request);
        $statement->bindParam("id", $id);
        $statement->execute();

        $service = $statement->fetch();

        return ($service);
    }
}