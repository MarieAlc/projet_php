
<h2>Prendre Rendez-vous</h2>
<form action="index.php?action=validerrdv" method="post" >

    <label for="nom">Nom *</label><br>
    <input type="text" id="nom" name="nom" required><br><br>

    <label for="prenom">Prénom *</label><br>
    <input type="text" id="prenom" name="prenom" required><br><br>

    <label for="email">Adresse e-mail *</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telephone">Téléphone</label><br>
    <input type="tel" id="telephone" name="telephone"><br><br>

    <label for="date">Date souhaitée *</label><br>
    <input type="date" id="date" name="date" required><br><br>

    <label for="heure">Heure souhaitée</label><br>
    <input type="time" id="heure" name="heure"><br><br>

    <label for="motif">Motif du rendez-vous *</label><br>    
    <select id="motif" name="motif" required>
        
        <?php foreach ($services as $service): ?>
            <option value="<?= $service->getId() ?>"><?= $service->getNom() ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Valider le rendez-vous</button>
</form>





</form>