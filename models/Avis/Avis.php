<?php
include_once 'models/abstractEntity.php';

class Avis extends AbstractEntity {
    private $id;
    private $nomPatient;
    private $note;
    private $commentaire;
    private $photo;
    private $dateAvis;

    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setNomPatient($nomPatient) {
        $this->nomPatient = $nomPatient;
    }
    public function getNomPatient() {
        return $this->nomPatient;
    }

    public function setNote($note) {
        $this->note = $note;
    }
    public function getNote() {
        return $this->note;
    }
    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }
    public function getCommentaire() {
        return $this->commentaire;
    }
    public function setPhoto($photo) {
        $this->photo = $photo;
    }
    public function getPhoto() {
        return $this->photo;
    }
    public function setDateAvis($dateAvis) {
        $this->dateAvis = $dateAvis;
    }
    public function getDateAvis() {
        return $this->dateAvis;
    }
}