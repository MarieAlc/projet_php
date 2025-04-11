<?php
include_once ('models/DBManager.php');

abstract class abstractEntityManager {

    public $db;
    
    public function __construct() {
       $this->db = DBManager::getInstance()->db;
    }

   
}