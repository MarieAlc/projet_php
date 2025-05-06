<?php
if (isset($_SESSION['message'])) {
    echo '<div class="confirmation-message">' . htmlspecialchars($_SESSION['message']) . '</div>';

    unset($_SESSION['message']);
}
?>
<h2>Prendre Rendez-vous</h2>
<div class="form-container">
    <form action="index.php?action=validerrdv" method="post">

        <?php if (!isset($_SESSION['user'])): ?>

            <label for="nom">Nom *</label><br>
            <input type="text" id="nom" name="nom" required><br><br>

            <label for="prenom">Prénom *</label><br>
            <input type="text" id="prenom" name="prenom" required><br><br>

            <label for="mail">Adresse e-mail *</label><br>
            <input type="email" id="mail" name="mail" required><br><br>

            <label for="telephone">Téléphone</label><br>
            <input type="tel" id="telephone" name="telephone"><br><br>
        <?php else: ?>
            <p><strong>Nom :</strong> <?= htmlspecialchars($_SESSION['user']['nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($_SESSION['user']['prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($_SESSION['user']['mail']) ?></p>
        <?php endif; ?>

        <label for="date">Date souhaitée *</label><br>
        <input type="date" id="date" name="date" required><br><br>

        <label for="heure">Heure souhaitée</label><br>
        <input type="time" id="heure" name="heure"><br><br>

        <label for="motif">Motif du rendez-vous *</label><br>    
        <select id="motif" name="motif" required>
            <?php foreach ($services as $service): ?>
                <option value="<?= $service->getId() ?>"><?= htmlspecialchars($service->getNom()) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Valider le rendez-vous</button>
    </form>
</div>