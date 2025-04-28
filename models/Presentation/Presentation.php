<?php

include_once 'models/abstractEntity.php';

class Presentation extends AbstractEntity {
    private $id;
    private $texte;

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setTexte($texte) {
        $this->texte = $texte;
    }
    public function getTexte() {
        return $this->texte;
    }


}