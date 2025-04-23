<?php

class Utilisateur {

    private int $id;
    private string $email;
    private string $motDePasse;
    private string $nom;
    private string $prenom;
    private int $telephone;
    private string $isAdmin;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? 0;
        $this->nom = $data['nom'] ?? '';
        $this->prenom = $data['prenom'] ?? '';
        $this->mail = $data['mail'] ?? '';
        $this->motDePasse = $data['motDePasse'] ?? '';
        $this->telephone = $data['telephone'] ?? '';
        $this->isAdmin = $data['isAdmin'] ?? 0;
    }

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

    public function setMail(string $mail): void {
        $this->mail = $mail;
    }
    public function getMail(): string {
        return $this->mail;
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