<?php
include_once __DIR__ . '/config/config.php';

include_once __DIR__ . '/models/Services/Service.php';
include_once __DIR__ . '/models/Services/ServiceManager.php';

include_once __DIR__ . '/models/Actualites/Actualites.php';
include_once __DIR__ . '/models/Actualites/ActualitesManager.php';
include_once __DIR__ . '/models/Horaires/Horaire.php';
include_once __DIR__ . '/models/Horaires/HoraireManager.php';

include_once __DIR__ . '/models/Presentation/PresentationManager.php';
include_once __DIR__ . '/models/Presentation/Presentation.php';

include_once __DIR__ . '/models/rendezvous/RendezVous.php';
include_once __DIR__ . '/models/rendezvous/RendezVousManager.php';

include_once __DIR__ . '/models/Apropos/Apropos.php';
include_once __DIR__ . '/models/Apropos/AproposManager.php';

include_once __DIR__ . '/models/utilisateur/Utilisateur.php';
include_once __DIR__ . '/models/utilisateur/UtilisateurManager.php';

include_once __DIR__ . '/views/views.php';
include_once __DIR__ . '/Controllers/Controller.php';
include_once __DIR__ . '/Controllers/ControllerUtilisateur.php';
include_once __DIR__ . '/Controllers/ControllerProfil.php';
include_once __DIR__ . '/Controllers/controllerAdmin/ControllerAdmin.php';
include_once __DIR__ . '/Controllers/controllerAdmin/ControllerRendezVous.php';
include_once __DIR__ . '/Controllers/controllerAdmin/ControllerActualite.php';
include_once __DIR__ . '/Controllers/controllerAdmin/ControllerHoraire.php';
include_once __DIR__ . '/Controllers/ControllerGestionUtilisateur.php';
include_once __DIR__ . '/Controllers/controllerAdmin/ControllerServices.php';
include_once __DIR__ . '/Controllers/ControllerAvis.php';
include_once __DIR__ . '/Controllers/controllerAdmin/ControllerApropos.php';
