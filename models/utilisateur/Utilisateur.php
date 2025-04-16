<?php

class Utilisateur {

    private int $id;
    private string $email;
    private string $motDePasse;
    private string $nom;
    private string $prenom;
    private int $telephone;
    private string $isAdmin;

    public function setId(int $id): void {        $this->id = $id;
    }
    public function getId(): int {
        return $this->id;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
    public function getNom(): string {
        return $this->nom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }
    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setTelephone(int $telephone): void {
        $this->telephone = $telephone;
    }
    public function getTelephone(): int {
        return $this->telephone;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }
    public function getEmail(): string {
        return $this->email;
    }

    public function setMotDePasse(string $motDePasse): void {
        $this->motDePasse = password_hash($motDePasse, PASSWORD_BCRYPT);
    }
    public function getMotDePasse(): string {
        return $this->motDePasse;
    }

    public function setIsAdmin(string $isAdmin): void {
        $this->role = $isAdmin;
    }

    public function getIsAdmin(): string {
        return $this->isAdmin;
    }
}