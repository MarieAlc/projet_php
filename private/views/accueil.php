   
    <section >
        <h2>Présentation</h2>
        <div class="presentation">
            <p><?= $presentation ?></p> 
        </div>
        <div class="images">
            <img src="public/image/lampe.jpg" alt="dentiste dans son cabinet" width="300" height="200">
            <img src="public/image/radio.jpg" alt="dentiste avec radio" width="300" height="200">
            <img src="public/image/siege.jpg" alt="cabinet dentiste" width="300" height="200">
        </div>
    </section>
    
    <section>
        <div class="services">
            <h2>Nos services</h2>
            <ul >
                <?php foreach ($services as $service): ?>
                    <li>
                    <a href="index.php?action=detailservices&id=<?= $service->getId() ?>">
                    <?= $service->getNom() ?> - <?= $service->getPrix() ?> €</a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </section>
    
    <section>
    <h2>Horaires d'ouverture</h2>
        <ul class="horaires">
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

<div class="btnRdv">
    <?php if (isset($_SESSION['user'])): ?>
        <a  href="index.php?action=prendrerendezvous">
            <button>Prendre rendez-vous</button>
        </a>
    <?php else: ?>
        </a><button onclick="alert('Veuillez vous inscrire ou vous connecter pour prendre rendez-vous.')">
            Prendre rendez-vous
        </button>
    <?php endif; ?>
</div>