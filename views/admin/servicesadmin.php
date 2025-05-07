<h2>Gestion des Services</h2>
<?php if (!empty($message)): ?>
    <div class='confirmation-message'><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class='confirmation-erreur'>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<h3>Liste des Services</h3>
<section>
    <table class="tableServices">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service->getNom()) ?></td>
                    <td><?= htmlspecialchars($service->getDescription()) ?></td>
                    <td><?= htmlspecialchars($service->getPrix()) ?> €</td>
                    <td>
                        <a href="index.php?action=modifierservice&id=<?= $service->getId() ?>">Modifier</a>
                        <a href="index.php?action=supprimerService&id=<?= $service->getId() ?>" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</section>

<!-- Formulaire pour ajouter un service -->
<div class="form-container">
    <h3>Ajouter un Service</h3>
    <form action="index.php?action=ajouterService" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required><br><br>
        
        <label for="description">Description :</label>
        <textarea name="description" id="description" required></textarea><br><br>
        
        <label for="prix">Prix :</label>
        <input type="number" name="prix" id="prix" step="0.01" required><br><br>

        <button type="submit" name="action" value="ajouterService">Ajouter</button>
    </form>
</div>
