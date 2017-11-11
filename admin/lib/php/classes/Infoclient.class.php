<?php

class Infoclient {

    private $_attributs_de_bd = array();

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    // fonction hydrater = donner des valeurs aux attributs
    private function hydrate(array $data) {
        //$key = nom du champs; $value = sa valeur
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    public function __get($name) {
        if (isset($this->_attributs_de_bd[$name])) {
            return $this->_attributs_de_bd[$name];
        }
    }

    public function __set($nom, $valeur) {
        $this->_attributs_de_bd[$nom] = $valeur;
    }
    
    public function faireQqch(){
        print "";
    }

}
