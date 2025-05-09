<?php
 define('DB_HOST', 'db5017811596.hosting-data.io');
define('DB_NAME', 'dbs14210184');
define('DB_USER', 'dbu2184812');
define('DB_PASS', 'AppliDupont1');
try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
  
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}