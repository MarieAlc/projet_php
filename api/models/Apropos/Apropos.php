<?php
include_once __DIR__ . '/../abstractEntity.php';

class Apropos extends AbstractEntity{

    private int $id;
    private string $titre;
    private string $texte;

    public function setId (int $id): void{
        $this->id = $id;
    }
    public function getId (): int {
        return $this->id;
    }
    public function setTitre (string $titre): void{
        $this->titre = $titre;
    }
    public function getTitre (): string {
        return $this->titre;
    }
    public function setTexte (string $texte): void{
        $this->texte = $texte;
    }
    public function getTexte (): string {
        return $this->texte;
    }
}