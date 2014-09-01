<?php

include_once 'Noleggio.php';
include_once 'UserFactory.php';
include_once 'FilmFactory.php';

class NoleggioFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    /**
     * Cerca un noleggio corrispondente ai parameti passati
     * @param User $user
     * @param int $film_id
     * @param int $cliente_id
     * @param int $data_inizio
     * @param int $data_fine
     * @return array|\Film
     */
    public function &ricercaNoleggi($user, $film_id, $cliente_id, $data_inizio, $data_fine) {
        $noleggi = array();
        // costruisco la where "a pezzi" a seconda di quante
        // variabili sono definite
        $bind = "";
        $where = " where noleggi.id >= 0 ";
        $par = array();
        if (isset($film_id)) {
            $where .= " and idfilm = ? ";
            $bind .="i";
            $par[] = $film_id;
        }
        if (isset($cliente_id)) {
            $where .= " and idcliente = ? ";
            $bind .="i";
            $par[] = $cliente_id;
        }
        if (isset($data_inizio)) {
            if ($data_inizio != "") {
                $where .= " and data_inizio = ? ";
                $bind .="s";
                $par[] = $data_inizio;
            }
        }
        if (isset($data_fine)) {
            if ($data_fine != "") {
                $where .= " and data_fine = ? ";
                $bind .="s";
                $par[] = $data_fine;
            }
        }
        
        $query = "SELECT *
FROM noleggi
JOIN clienti ON id_cliente = clienti.id
JOIN veicoli ON id_film = film.id
" . $where;
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[ricercaNoleggi] impossibile inizializzare il database");
            $mysqli->close();
            return $noleggi;
        }
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[ricercaNoleggi] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return $noleggi;
        }
        switch (count($par)) {
            case 1:
                if (!$stmt->bind_param($bind, $par[0])) {
                    error_log("[ricercaNoleggi] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $noleggi;
                }
                break;
            case 2:
                if (!$stmt->bind_param($bind, $par[0], $par[1])) {
                    error_log("[ricercaNoleggi] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $noleggi;
                }
                break;
            case 3:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2])) {
                    error_log("[ricercaNoleggi] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $noleggi;
                }
                break;
            case 4:
                if (!$stmt->bind_param($bind, $par[0], $par[1], $par[2], $par[3])) {
                    error_log("[ricercaNoleggi] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return $noleggi;
                }
                break;
        }
        $noleggi = self::caricaNoleggiDaStmt($stmt);
        $mysqli->close();
        return $noleggi;
    }

    public function &caricaNoleggiDaStmt(mysqli_stmt $stmt) {
        $noleggi = array();
        if (!$stmt->execute()) {
            error_log("[caricaNoleggiDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['noleggi_id'], $row['noleggi_idfilm'], $row['noleggi_idcliente'], $row['noleggi_data_inizio'], $row['noleggi_data_fine'], $row['noleggi_totale'], $row['clienti_id'], $row['clienti_nome'], $row['clienti_cognome'], $row['clienti_username'], $row['clienti_password'], $row['film_id'], $row['film_titolo'], $row['film_regista'], $row['film_anno'], $row['film_genere'], $row['film_prezzo']);
        if (!$bind) {
            error_log("[caricaNoleggiDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }
        while ($stmt->fetch()) {
            $noleggi[] = self::creaDaArray($row);
        }
        $stmt->close();
        return $noleggi;
    }

    public function creaDaArray($row) {
        $noleggio = new Noleggio();
        $noleggio->setId($row['noleggi_id']);
        $noleggio->setCliente(UserFactory::instance()->creaClienteDaArray($row));
        $noleggio->setVeicolo(VeicoloFactory::instance()->creaVeicoloDaArray($row));
        $noleggio->setDatainizio($row['noleggi_data_inizio']);
        $noleggio->setDatafine($row['noleggi_data_fine']);
        $noleggio->setCosto($row['noleggi_totale']);
        return $noleggio;
    }

    /**
     * Salva il noleggio passato nel database, con transazione
     * @param Noleggio $noleggio
     * @return true se il salvataggio è andato a buon fine
     */
    public function nuovo($noleggio) {
        $query = "insert into noleggi (film_id, cliente_id, data_inizio, data_fine, totale)
values (?, ?, ?, ?, ?)";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[nuovo] impossibile inizializzare il database");
            return 0;
        }
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[nuovo] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }
        if (!$stmt->bind_param('iissd', $noleggio->getIdFilm(), $noleggio->getIdCliente(), $noleggio->getInizioNoleggio(), $noleggio->getFineNoleggio(), $noleggio->getTotale())) {
            error_log("[nuovo] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }
        // inizio la transazione
        $mysqli->autocommit(false);
        if (!$stmt->execute()) {
            error_log("[nuovo] impossibile" .
                    " eseguire lo statement");
            $mysqli->rollback();
            $mysqli->close();
            return 0;
        }
        //query eseguita correttamente, termino la transazione
        $mysqli->commit();
        $mysqli->autocommit(true);
        $mysqli->close();
        return $stmt->affected_rows;
    }
}
?>