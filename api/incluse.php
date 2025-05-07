<?php
include_once 'config/config.php';

include_once 'models/Services/Service.php';
include_once 'models/Services/ServiceManager.php';

include_once 'models/Actualites/Actualites.php';
include_once 'models/Actualites/ActualitesManager.php';
include_once 'models/Horaires/Horaire.php';
include_once 'models/Horaires/HoraireManager.php';

include_once 'models/Presentation/PresentationManager.php';
include_once 'models/presentation/Presentation.php';

include_once 'models/rendezvous/RendezVous.php';
include_once 'models/rendezvous/RendezVousManager.php';

include_once 'models/apropos/Apropos.php';
include_once 'models/apropos/AproposManager.php';

include_once 'models/utilisateur/Utilisateur.php';
include_once 'models/utilisateur/UtilisateurManager.php';

include_once '../views/Views.php';
include_once 'controllers/Controller.php';
include_once 'controllers/ControllerUtilisateur.php';
include_once 'controllers/ControllerProfil.php';
include_once 'controllers/controllerAdmin/ControllerAdmin.php';
include_once 'controllers/controllerAdmin/ControllerRendezVous.php';
include_once 'controllers/controllerAdmin/ControllerActualite.php';
include_once 'controllers/controllerAdmin/ControllerHoraire.php';
include_once 'controllers/ControllerGestionUtilisateur.php';
include_once 'controllers/controllerAdmin/ControllerServices.php';
include_once 'controllers/ControllerAvis.php';
include_once 'controllers/controllerAdmin/ControllerApropos.php';
