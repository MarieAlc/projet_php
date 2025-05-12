# projet_php
Projet de Gestion des Rendez-vous pour Dr. Dupont

Description
Ce projet de gestion des rendez-vous est conçu pour un cabinet dentaire, permettant à la fois aux patients et au personnel du cabinet de gérer les rendez-vous en ligne. Le système est divisé en deux parties : le front-office pour les patients et le back-office pour l'administrateur (Dr. Dupont et son équipe).

Le front-office permet aux patients de prendre un rendez-vous, consulter les horaires, les services,laisser un avis et leur profil.
Le back-office permet à l'administrateur de gérer les rendez-vous, les utilisateurs, les horaires, les actualites, la section a propos et les services.

Fonctionnalités principales

Inscription et Connexion : Les utilisateurs peuvent s'inscrire, se connecter et modifier leur profil.

Gestion des Rendez-vous : Les patients peuvent prendre un rendez-vous, tandis que l'administrateur peut valider, voir ou modifier les rendez-vous.

Tableau de bord administrateur : L'administrateur peut voir la liste des utilisateurs, des rendez-vous,la note moyenne et les services.

Envoi de mails : Les utilisateurs peuvent demander une réinitialisation de leur mot de passe par mail.

Technologies utilisées
Backend : PHP (PDO, gestion des sessions, validation des formulaires)

Frontend : HTML, CSS (Responsive design), JavaScript (menu burger)

Base de données : MySQL

Hébergement : Le site est hébergé sur un serveur (IONOS) avec une base de données MySQL.

Installation

Clonez ce dépôt :

bash
git clone https://github.com/MarieAlc/projet_php.git
Importez la base de données MySQL. Le fichier de structure de la base de données est inclus dans le projet sous applicationdentiste.sql

Configurez les paramètres de la base de données dans config.php (identifiants de la base de données, serveur, etc.).

Déployez le projet sur votre serveur ou utilisez un environnement local comme XAMPP.

Utilisation
Accédez au site via l'URL suivante :  http://s1049952647.onlinehome.fr/index.php?action=accueil

Créez un compte en tant que patient ou connectez-vous en tant qu'administrateur.

Utilisez les fonctionnalités de gestion des rendez-vous en fonction de votre rôle.

Lien vers le dépôt GitHub
https://github.com/MarieAlc/projet_php.git
