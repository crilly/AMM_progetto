<?php

class Noleggio {

    private $id;
    private $idFilm;
    private $idCliente;
    private $totale;
    private $inizioNoleggio;
    private $fineNoleggio;

    public function getId() {
        return $this->id;
    }

    public function getIdFilm() {
        return $this->idFilm;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function getTotale() {
        return $this->totale;
    }

    public function getInizioNoleggio() {
        return $this->inizioNoleggio;
    }

    public function getFineNoleggio() {
        return $this->fineNoleggio;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdFilm($idFilm) {
        $this->idFilm = $idFilm;
        return true;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
        return true;
    }

    public function setTotale($totale) {
        $this->totale = $totale;
        return true;
    }

    public function setInizioNoleggio($inizioNoleggio) {
        $this->inizioNoleggio = $inizioNoleggio;
        return true;
    }

    public function setFineNoleggio($fineNoleggio) {
        $this->fineNoleggio = $fineNoleggio;
        return true;
    }
}

?>
