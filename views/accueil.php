   
    <section >
        <h2>Présentation</h2>
        <div>
            <p><?= $presentation ?></p> 
        </div>
        <div>
            <img src="image/lampe.jpg" alt="dentiste dans son cabinet" width="300" height="200">
            <img src="image/radio.jpg" alt="dentiste avec radio" width="300" height="200">
            <img src="image/siege.jpg" alt="cabinet dentiste" width="300" height="200">
        </div>
    </section>
    
    <section>
        <h2>Nos services</h2>
        <ul>
            <?php foreach ($services as $service): ?>
                <li>
                <a href="index.php?action=detailservices&id=<?= $service->getId() ?>">
                <?= $service->getNom() ?> - <?= $service->getPrix() ?> €</a>
                </li>
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

    <button><a href="index.php?action=prendrerendezvous">Prendre rendez-vous</a></button>