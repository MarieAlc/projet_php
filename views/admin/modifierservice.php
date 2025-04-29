<h2>Modifier un service</h2>

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

<form action="index.php?action=modifierservice" method="post">
    <input type="hidden" name="id" value="<?= $service->getId() ?>">

    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($service->getNom()) ?>" required><br><br>

    <label for="description">Description :</label>
    <textarea name="description" id="description" required><?= htmlspecialchars($service->getDescription()) ?></textarea><br><br>

    <label for="prix">Prix :</label>
    <input type="number" name="prix" id="prix" value="<?= htmlspecialchars($service->getPrix()) ?>" step="0.01" required><br><br>

    <button type="submit">Modifier</button>
</form>