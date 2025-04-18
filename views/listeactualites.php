<?php

  echo("<h1>Actualités</h1>");
  setlocale(LC_TIME, 'fr_FR.UTF-8');  // Spécifie la locale française
  
  foreach ($listeActualites as $actualite) {
      $actualiteTitre = $actualite->getTitre();
      $actualiteContenu = $actualite->getContenu();
      $actualiteDate = $actualite->getDate();  // Suppose que c'est un objet DateTime
  
      // Utilise la méthode format de DateTime pour formater la date
      $actualiteDateFormatee = $actualiteDate->format('d F Y');  // Format jour mois année
  
      echo "<h3>$actualiteTitre</h3>";
      echo "<p>$actualiteContenu</p>";
      echo "<p><em>Publié le $actualiteDateFormatee</em></p>";
  }
  