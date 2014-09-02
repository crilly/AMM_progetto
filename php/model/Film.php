<?php

/**
 * Classe che rappresenta un film *
 * @author Cristin Sanna
 */
class Film {

    //Titolo del film
    private $titolo;

    //Regista
    private $regista;

    //Anno
    private $anno;
    
    //Genere
    private $genere;

    //Costruttore    
    public function __costruct() {
        
    }

    //Restituisce l'ID del film
    public function getId() {
        return $this->id;
    }

    //Imposta l'ID 
    public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
    }
    
    //Imposta il genere 
    public function setGenere($genere) {
        $varVal = filter_var($genere, FILTER_VALIDATE_var, FILTER_NULL_ON_FAILURE);
        if (!isset($varVal)) {
            return false;
        }
        $this->genere = $varVal;
    }

    //Imposta l'anno
    public function setAnno($anno) {
        $intVal = filter_var($anno, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (isset($intVal)) {
            if ($intVal > 1930 && $intVal <= date("Y")) {
                $this->anno = $intVal;
                return true;
            }
        }
        return false;
    }
       
    //Restituisce l'anno
    public function getTitolo() {
        return $this->titolo;
    }
    
    //Restituisce l'anno
    public function getAnno() {
        return $this->anno;
    }
    
    //Restituisce il regista
    public function getRegista() {
        return $this->regista;
    }
    
    //Restituisce il genere
    public function getGenere() {
        return $this->genere;
    }
    
}

?>