<?php
include_once 'models/AbstractEntityManager.php';
class PresentationManager extends AbstractEntityManager{

    public function getPresentation(){
        $sql = "SELECT * FROM presentation";
        $statement = $this->db->query($sql);
        $presentation = $statement->fetch();
        return $presentation['texte'];
    }

}