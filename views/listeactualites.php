<?php

  echo("<h1>Actualités</h1>");
  setlocale(LC_TIME, 'fr_FR.UTF-8'); 
  
  foreach ($listeActualites as $actualite) {
      $actualiteTitre = $actualite->getTitre();
      $actualiteContenu = $actualite->getContenu();
      $actualiteDate = $actualite->getDate();  
  
      $actualiteDateFormatee = $actualiteDate->format('d m Y'); 
  
      echo "<h3>$actualiteTitre</h3>";
      echo "<p>$actualiteContenu</p>";
      echo "<p><em>Publié le $actualiteDateFormatee</em></p>";
  }
  