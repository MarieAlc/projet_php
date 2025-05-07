<?php
include_once __DIR__ . '/../abstractEntity.php';

class RendezVous extends AbstractEntity{
    private int $id;
    private string $date;
    private  DateTime $heure;
    private string $motif;
    private string $motifNom;
    private int $idClient;
    private string $mailPatient;
    private bool $statut;

    
    public function setStatut (bool $statut): void{
        $this->statut = $statut;
    }
    public function getStatut (): bool {
        return $this->statut;
    }
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
    public function setHeure($heure) {
        if (is_string($heure)) {
            try {
                $heure = new DateTime($heure);
            } catch (Exception $e) {
                throw new Exception("Format d'heure invalide : " . $heure);
            }
        }
    
        if (!$heure instanceof DateTime) {
            throw new TypeError("RendezVous::setHeure() attend un objet DateTime, reçu " . gettype($heure));
        }
    
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

    public function setMotifNom (string $nom): void{
        $this->motifNom = $nom;
    }
    public function getMotifNom (): string {
        return $this->motifNom;
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