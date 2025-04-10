<?php

function render ($viewName, $params){
    ob_start();
    extract($params);
    include_once "views/" . $viewName . ".php";
    $content = ob_get_clean();
    include_once 'mainTemplate.php';
}
