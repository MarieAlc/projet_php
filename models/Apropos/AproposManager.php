<?php
include_once 'models/AbstractEntityManager.php';

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
}