<?php

include_once __DIR__ . '/../AbstractEntity.php';

class Horaire extends AbstractEntity {

    private int $id;
    private string $jour;
    private DateTime  $heure_debut;
    private DateTime  $heure_fin;
    private bool $ouvert;

    public function __construct(array $data = []) {
        parent::__construct($data);
        // Vérifier que les valeurs sont bien définies
        $this->heure_debut = new DateTime($data['heure_debut'] ?? '00:00:00');
        $this->heure_fin = new DateTime($data['heure_fin'] ?? '00:00:00');
    }
    

    public function setId(int $id): void { $this->id = $id; }
    public function getId(): int { return $this->id; }

    public function setJour(string $jour): void { $this->jour = $jour; }
    public function getJour(): string { return $this->jour; }

    public function setHeure_debut(DateTime  $heure_debut): void { $this->heure_debut = $heure_debut; }
    public function getHeure_debut(): DateTime  { return $this->heure_debut; }

    public function setHeure_fin(DateTime  $heure_fin): void { $this->heure_fin = $heure_fin; }
    public function getHeure_fin(): DateTime  { return $this->heure_fin; }

    public function setOuvert(bool $ouvert): void { $this->ouvert = $ouvert; }
    public function getOuvert(): bool { return $this->ouvert; }

    



}