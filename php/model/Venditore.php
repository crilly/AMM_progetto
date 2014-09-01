<?php

include_once 'User.php';

/**
 * Classe che rappresenta un venditore
 */
class Venditore extends User {

    /**
     * Costruttore della classe
     */
    public function __construct() {
        //Richiamiamo il costruttore della superclasse
        parent::__construct();
        $this->setRuolo(User::Venditore);
    }

}

?>