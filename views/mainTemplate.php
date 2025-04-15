<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DR.Dupont</title>
</head>
<header>
    <nav style="display: flex; justify-content: space-between; background-color:rgb(168, 200, 232); padding: 10px;">
        <div>LOGO</div>
        <div>
            <ul style="list-style: none; display: flex; gap: 20px; margin: 0; padding: 0;">
                <li>Accueil</li>
                <li><a href="index.php?action=listeservices">Services</a></li>
                <li><a href="index.php?action=actualites">Actualitées</a></li>
                <li>Rendez-Vous</li>
                <li>A propos</li>
         </ul>
        </div>
    </nav>
</header>
<body>
    <h1>Bienvenue sur le site du DR.Dupont</h1>
    <main>
        <?= $content ?>
    </main>
</body>
<footer>
    <div style="background-color:rgb(168, 200, 232); padding: 10px; text-align: center;">
        <p>&copy; 2025 DR.Dupont. Tous droits réservés.</p>
        <p>Mentions légales | Politique de confidentialité</p>
    </div>
</footer>
</html>