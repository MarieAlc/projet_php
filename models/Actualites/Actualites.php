<?php
include_once 'models/abstractEntity.php';

class Actualite extends AbstractEntity  {
    private int $id;
    private string $titre;
    private string $contenu;
    private DateTime $date;


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

    public function setDate ( string $date):void {
        $this->date = New DateTime($date);
    }

    public function getDate (): DateTime {
        return $this->date;
    }

}