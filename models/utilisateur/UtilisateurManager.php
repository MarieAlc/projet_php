<?php
include_once 'models/AbstractEntityManager.php';

class UtilisateurManager extends AbstractEntityManager {

    public function listeUtilisateurs() {
        $sql = "SELECT * FROM utilisateur";
        $statement = $this->db->query($sql);

        $utilisateurs = [];
        while ($utilisateurData = $statement->fetch()) {
            $utilisateurs[] = new Utilisateur($utilisateurData);
        }

        return $utilisateurs;
    }

    public function ajouterUtilisateur($nom, $prenom, $mail, $mot_de_passe_hash, $telephone) {
        $sql = "INSERT INTO utilisateurs (nom, prenom, mail, mot_de_passe, telephone, isAdmin)
                VALUES (:nom, :prenom, :mail, :mot_de_passe, :telephone, 0)";
        
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail,
            'mot_de_passe' => $mot_de_passe_hash,
            'telephone' => $telephone
        ]);
    }
}