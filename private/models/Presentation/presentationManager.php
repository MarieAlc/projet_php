<?php
require_once '/homepages/9/d4298990792/htdocs/siteweb/private/models/AbstractEntityManager.php';
class PresentationManager extends AbstractEntityManager{

    public function getPresentation(){
        $sql = "SELECT * FROM presentation";
        $statement = $this->db->query($sql);
        $presentation = $statement->fetch();
        return $presentation['texte'];
    }

}