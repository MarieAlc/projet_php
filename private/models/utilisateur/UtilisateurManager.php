<?php
require_once '/homepages/9/d4298990792/htdocs/siteweb/private/models/AbstractEntityManager.php';

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

    public function getUtilisateurById($id) {
        $sql = "SELECT * FROM utilisateur WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
    
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        return new Utilisateur($data);
    }

    public function ajouterUtilisateur($nom, $prenom, $mail, $motDePasseHash, $telephone, $role) {
        try {
            if (!$this->isEmailUnique($mail)) {
                throw new Exception('L\'email est déjà utilisé.');
            }
    
        $sql = "INSERT INTO utilisateur (nom, prenom, mail, motDePasse, telephone, isAdmin)
                VALUES (:nom, :prenom, :mail, :motDePasse, :telephone, :isAdmin)";
        
        $statement = $this->db->prepare($sql);
        $statement->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail,
            'motDePasse' => $motDePasseHash,
            'telephone' => $telephone,
            'isAdmin' => $role
        ]);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }

        return ['success' => 'Utilisateur ajouté avec succès.'];
    }

    public function modifierUtilisateur($id, $nom, $prenom, $mail, $telephone, $motDePasse = null) {
        if ($motDePasse) {
            $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);
            $sql = "UPDATE utilisateur 
                    SET nom = :nom, prenom = :prenom, mail = :mail, telephone = :telephone, motDePasse = :motDePasse 
                    WHERE id = :id";
            $params = [
                'nom' => $nom,
                'prenom' => $prenom,
                'mail' => $mail,
                'telephone' => $telephone,
                'motDePasse' => $motDePasseHash,
                'id' => $id
            ];
        } else {
            $sql = "UPDATE utilisateur 
                    SET nom = :nom, prenom = :prenom, mail = :mail, telephone = :telephone 
                    WHERE id = :id";
            $params = [
                'nom' => $nom,
                'prenom' => $prenom,
                'mail' => $mail,
                'telephone' => $telephone,
                'id' => $id
            ];
        }
    
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
    }
    public function supprimerUtilisateur($id) {
        $sql = "DELETE FROM utilisateur WHERE id = :id";
        $statement = $this->db->prepare($sql);
        $statement->execute(['id' => $id]);
        return $statement->fetchColumn() == 0;
    }

    public function peutSupprimerUtilisateur($id) {
        // Vérifier si l'utilisateur a des rendez-vous associés
        $sql = "SELECT COUNT(*) FROM rendezvous WHERE idClient = :idClient";
        $statement = $this->db->prepare($sql);
        $statement->execute(['idClient' => $id]);
        
        $result = $statement->fetchColumn();
        
      
        if ($result > 0) {
            return false;
        }
    
        return true; 
    }
    





}