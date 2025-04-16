<?php
include_once 'models/abstractEntity.php';

class RendezVous extends AbstractEntity{
    private int $id;
    private string $date;
    private DateTime $heure;
    private string $motif;
    private int $idClient;
    private string $mailPatient;
    
    public function setId (int $id): void{
        $this->id = $id;
    }
    public function getId (): int {
        return $this->id;
    }
    public function setDate (string $date): void{
        $this->date = $date;
    }
    public function getDate (): string {
        return $this->date;
    }
    public function setHeure (DateTime $heure): void{
        $this->heure = $heure;
    }
    public function getHeure (): DateTime {
        return $this->heure;
    }
    public function setMotif (string $motif): void{
        $this->motif = $motif;
    }
    public function getMotif (): string {
        return $this->motif;
    }
    public function setIdClient (int $idClient): void{
        $this->idClient = $idClient;
    }
    public function getIdClient (): int {
        return $this->idClient;
    }
    public function setMailPatient (string $mailPatient): void{
        $this->mailPatient = $mailPatient;
    }
    public function getMailPatient (): string {
        return $this->mailPatient;
    }
    public function __toString(): string {
        return $this->date . ' à ' . $this->heure->format('H:i') . ' - ' . $this->motif;
    }
}