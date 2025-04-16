<?php
include_once 'models/abstractEntity.php';

class Service extends AbstractEntity {
    private int $id;
    private string $nom;
    private string $description;
    private int $prix;


    public function setId (int $id): void{
        $this->id = $id;
    }

    public function getId (): int {
        return $this->id;
    }

    public function setNom (string $nom){
        $this->nom = $nom;
    }

    public function getNom (): string {
        return $this->nom;
    }

    public function setDescription (string $description){
        $this->description = $description;
    }
    public function getDescription (): string {
        return $this->description;
    }

    public function setPrix (int $prix){
        $this->prix = $prix;
    }
    public function getPrix (): int {
        return $this->prix;
    }
}