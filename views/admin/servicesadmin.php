<h2>Gestion des Services</h2>
<?php if (!empty($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <ul style="color: red;">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<h3>Liste des Services</h3>
<table>
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

<!-- Formulaire pour ajouter un service -->
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
