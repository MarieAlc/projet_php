<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dr. Dupont</title>
</head>
<body>
    
    <section>
        <h2>Présentation</h2>
        <p><?= $presentation ?></p> <!-- Présentation dynamique du Dr. Dupont -->
    </section>
    
    <section>
        <h2>Nos services</h2>
        <ul>
        <?php foreach ($services as $service): ?>
                <li><?= $service->getNom() ?> - <?= $service->getDescription() ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
    
    <section>
    <h2>Horaires d'ouverture</h2>
        <ul>
            <?php foreach ($horaires as $horaire): ?>
                <li>
                    <?= $horaire->getJour() ?> : 
                    <?php if ($horaire->getOuvert() == 0): ?>
                        <?= $horaire->getHeure_debut()->format('H:i') . ' - ' . $horaire->getHeure_fin()->format('H:i') ?>
                    <?php else: ?>
                        Fermé
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <button><a href="prendre-rendez-vous.php">Prendre rendez-vous</a></button>
</body>
</html>
