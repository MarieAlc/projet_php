<?php
include_once 'models/abstractEntity.php';

class service extends abstractEntity {
    private int $id;
    private string $nom;
    private string $description;



    // verifier syntaxe + rapide a faire 
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
}