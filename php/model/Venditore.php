<?php

include_once 'User.php';

/**
 * Classe che rappresenta un cliente
 */
class Cliente extends User {

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