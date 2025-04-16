<?php

class ControllerUtilisateur {

public function showInscription() {
    $views = new Views();
    $views->render("inscription", []);
}

public function verifInscription() {
    // traitement du formulaire ici
}

public function showConnexion() {
    $views = new Views();
    $views->render("connexion", []);
}
}