<?php
class Views {    
    function render ($viewName, $params){
        ob_start();
        extract($params);
        include_once __DIR__ . "/../views/" . $viewName . ".php";
        $content = ob_get_clean();
        include_once 'views/mainTemplate.php';
    }
}