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
    public function modifierRoleUtilisateur($userId, $newRole) {
        // Vérifier que le nouveau rôle est soit 0 (utilisateur) soit 1 (admin)
        if (!in_array($newRole, [0, 1])) {
            throw new Exception("Rôle invalide.");
        }
    
        // Mettre à jour le rôle dans la base de données
        $sql = "UPDATE utilisateur SET isAdmin = :isAdmin WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'isAdmin' => $newRole,
            'id' => $userId
        ]);
    }
    public function isEmailUnique($mail) {
        $sql = "SELECT COUNT(*) FROM utilisateur WHERE mail = :mail";
        $statement = $this->db->prepare($sql);
        $statement->execute(['mail' => $mail]);
    
        return $statement->fetchColumn() == 0;  // Si l'email n'est pas trouvé, on retourne true (disponible)
    }
    public function getUtilisateurByEmail($mail) {
    
        $query = "SELECT * FROM utilisateur WHERE mail = :mail";
        $statement = $this->db->prepare($query);
        $statement->execute(['mail' => $mail]);
        
        return $statement->fetch(PDO::FETCH_ASSOC); 
    }

    public function ajouterUtilisateur($nom, $prenom, $mail, $motDePasseHash, $telephone) {
        try {
            // Vérifier si l'email est déjà utilisé
            if (!$this->isEmailUnique($mail)) {
                throw new Exception('L\'email est déjà utilisé.');
            }
    
        $sql = "INSERT INTO utilisateur (nom, prenom, mail, motDePasse, telephone, isAdmin)
                VALUES (:nom, :prenom, :mail, :motDePasse, :telephone, 0)";
        
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail,
            'motDePasse' => $motDePasseHash,
            'telephone' => $telephone
        ]);
        } catch (Exception $e) {
            // Retourne l'erreur si l'email est déjà pris ou autre problème
            return ['error' => $e->getMessage()];
        }

        return ['success' => 'Utilisateur ajouté avec succès.'];
    }
}
