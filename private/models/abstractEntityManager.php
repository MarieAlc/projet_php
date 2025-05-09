<?php
include_once __DIR__ . '/../models/DBManager.php';


abstract class AbstractEntityManager {

    public $db;
    
    public function __construct() {
       $this->db = DBManager::getInstance()->db;
    }

   
}