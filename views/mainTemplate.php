
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DR.Dupont</title>
    <link rel="stylesheet" href="asset/style.css">

</head>
<header>
    <nav >
        <div><img src="image/logo.png" alt="logo" style="height: 50px;"></div>
        <div>
            <ul style="list-style: none; display: flex; gap: 20px; margin: 0; padding: 0;">
                <li><a href="index.php?action=accueil">Accueil</a></li>
                <li><a href="index.php?action=listeservices">Services</a></li>
                <li><a href="index.php?action=actualites">Actualitées</a></li>
                <li><a href="index.php?action=apropos">A propos</a></li>
                
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['isAdmin'] == 1): ?>
                    <li><a href="index.php?action=profiladmin">Profil Admin</a></li>
                    <li><a href="index.php?action=deconnexion">Déconnexion</a></li>
                    
                    <?php elseif (isset($_SESSION['user'])): ?>
                        <li><a href="index.php?action=prendrerendezvous">Rendez-Vous</a></li>
                    <li><a href="index.php?action=profil">Profil</a></li>
                    <li><a href="index.php?action=deconnexion">Déconnexion</a></li>

                <?php else: ?>
                    <li><a href="index.php?action=inscription">Inscription</a></li>
                    <li><a href="index.php?action=connexion">Connexion</a></li>
                <?php endif; ?>
                <li><a href="index.php?action=avis">Avis des patients</a></li>

         </ul>
        </div>
    </nav>
    </header>
    <body>
        <h1>Bienvenue sur le site du DR.Dupont</h1>       
        <main>
            <?= $content ?>
        </main>
        <footer>
            <div >
                <p>&copy; 2025 DR.Dupont. Tous droits réservés.</p>
                <p>Mentions légales | Politique de confidentialité</p>
            </div>
        </footer>
        
    </body>
</html>