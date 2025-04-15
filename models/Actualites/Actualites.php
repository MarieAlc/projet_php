<?php
include_once 'models/abstractEntity.php';

class Actualite extends AbstractEntity  {
    private int $id;
    private string $titre;
    private string $contenu;
    private date $date_publication;


    public function setId (int $id): void{
        $this->id = $id;
    }

    public function getId (): int {
        return $this->id;
    }

    public function setTitre (string $titre){
        $this->titre = $titre;
    }

    public function getTitre (): string {
        return $this->titre;
    }

    public function setContenu (string $contenu){
        $this->contenu = $contenu;
    }
    public function getContenu (): string {
        return $this->contenu;
    }

    public function setDate ( date $date_publication){
        $this->date_publication = $date_publication;
    }

    public function getDate (): date {
        return $this->date_publication;
    }
}