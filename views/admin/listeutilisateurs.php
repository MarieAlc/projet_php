<h2>Liste des utilisateurs</h2>

<?php if (!empty($message)): ?>
    <div class='confirmation-message' style="color: green;"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class ='confirmation-erreur'>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
    </div>
<?php endif; ?>
<section>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?= htmlspecialchars($utilisateur->getNom()) ?></td>
                    <td><?= htmlspecialchars($utilisateur->getPrenom()) ?></td>
                    <td><?= htmlspecialchars($utilisateur->getMail()) ?></td>
                    <td><?= htmlspecialchars($utilisateur->getTelephone())?></td>
                    <td><?= $utilisateur->getIsAdmin() == 1 ? 'Administrateur' : 'Utilisateur' ?></td>
                    <td class='btnAdmin'>
                    <?php if ($utilisateur->getIsAdmin() == 0): ?>
                            <form action="index.php?action=modifieradmin" method="post">
                                <input type="hidden" name="userId" value="<?= $utilisateur->getId() ?>">
                                <input type="hidden" name="newRole" value="1"> 
                                <input type="submit" value="Promouvoir admin">
                            </form>
                        <?php else: ?>
                            <form action="index.php?action=modifieradmin" method="post">
                                <input type="hidden" name="userId" value="<?= $utilisateur->getId() ?>">
                                <input type="hidden" name="newRole" value="0">
                                <input type="submit" value="Démouvoir">
                            </form>
                        <?php endif; ?>
    
                    
                        <a class='modif'href="index.php?action=modifierutilisateur&id=<?= $utilisateur->getId() ?>">Modifier</a> 
    
                       
                        <a class='supp' href="index.php?action=supprimerUtilisateur&id=<?= $utilisateur->getId() ?>" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    
</section>
    <div class="form-container">
        <h2>Ajouter un nouvel utilisateur</h2>
        <form action="index.php?action=ajouterutilisateur" method="post">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required><br><br>
            
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required><br><br>
            
            <label for="email">Email :</label>
            <input type="email" name="mail" id="mail" required><br><br>
            <label>Téléphone :</label>
            <input type="tel" name="telephone" required><br><br>
            
            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="0">Utilisateur</option>
                <option value="1">Administrateur</option>
            </select><br><br>
            
            <label for="motdepasse">Mot de passe :</label>
            <input type="password" name="motdepasse" id="motdepasse" required><br><br>
            
            <button type="submit" name="action" value="ajouterutilisateur">Ajouter</button>
        </form>
    </div>