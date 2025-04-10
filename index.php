<?php
include_once 'models/services.php';
include_once 'views/views.php';
include_once 'controllers/controller.php';


$action = $_REQUEST['action'] ?? 'listeServices';

switch ($action) {

    case 'listeservices':        
        showListeServices();
        break;

    case 'detailservices':
        showDetailService();
        break;







    default:
        echo('<h1>Erreur 404</h1>');
        break;
}


?>