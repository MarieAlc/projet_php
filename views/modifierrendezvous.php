<h2>Modifier le rendez-vous</h2>

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

<form action="index.php?action=modifierrendezvous&id=<?= $rdv->getId() ?>" method="post">
    <label for="date">Date :</label>
    <input type="date" name="date" value="<?= $rdv->getDate() ?>" required><br>

    <label for="heure">Heure :</label>
    <input type="time" name="heure" value="<?= $rdv->getHeure()->format('H:i') ?>" required><br>

    <label for="motif">Motif :</label>
    <select name="motif" required>
        <?php foreach ($services as $service): ?>
            <option value="<?= $service->getId() ?>" <?= $service->getId() == $rdv->getMotif() ? 'selected' : '' ?>>
                <?= htmlspecialchars($service->getNom()) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="mailPatient">Email du patient :</label>
    <input type="email" name="mailPatient" value="<?= $rdv->getMailPatient() ?>" required><br>

    <input type="submit" value="Modifier le rendez-vous">
</form>
