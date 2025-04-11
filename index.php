<?php
include_once 'config/config.php';
include_once 'models/service.php';
include_once 'models/serviceManager.php';
include_once 'views/views.php';
include_once 'controllers/controller.php';


$action = $_REQUEST['action'] ?? 'listeservices';

try {
    $controller = new Controller();
    //code...
    switch ($action) {
    
        case 'listeservices':        
            $controller -> showListeServices();
            break;
    
        case 'detailservices':
            $controller -> showDetailService();
            break;
    
    
        default:
            echo('<h1>Erreur 404</h1>');
            break;
    }
} catch (\Throwable $th) {
    echo('<h1>Erreur 404</h1>');
    var_dump($th);
}


