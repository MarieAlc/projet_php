<?php

class abstractEntity{

    public function __construct (array $data = []){
        // hydrate l'objet avec les données du tableau associatif
        if(!empty($data)){
            $this->hydrate($data);
        }
    }
    
    public function hydrate (array $data=[]){

        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_','',ucwords($key,'_'));
            // on remplace le _ par rien et on met la premiere lettre en majuscule
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

    }
}