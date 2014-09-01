<?php

include_once 'Film.php';

class FilmFactory {

    private static $singleton;

    private function __constructor() {
        
    }

    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new FilmFactory();
        }
        return self::$singleton;
    }

    public function &getListaFilm() {
        $film = array();
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("[getListaFilm] Impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        if ($mysqli->connect_errno != 0) {
            $idErrore = $mysqli->connect_errno;
            $msg = $mysqli->connect_error;
            error_log("[getListaFilm] Errore nella connessione al server.", 0);
            //echo "Errore nella connessione $msgm, $idErrore";
            return null;
        } else {
            $stmt = $mysqli->stmt_init();
            $query = "select
film.id film_id,
film.titolo film_titolo,
film.regista film_regista,
film.anno film_anno,
film.genere film_genere,
film.prezzo film_prezzo,
from film";
            $stmt->prepare($query);
            if (!isset($mysqli)) {
                error_log("[getListaFilm] Impossibile inizializzare il database");
                $mysqli->close();
                return $film;
            }
            $result = $mysqli->query($query);
            if ($mysqli->errno > 0) {
                error_log("[getListaFilm] Impossibile eseguire la query");
                $mysqli->close();
                return $film;
            }
            while ($row = $result->fetch_array()) {
                $film[] = self::creaProdottiDaArray($row);
            }
            $mysqli->close();
            return $film;
        }
    }

    public function creaFilmDaArray($row) {
        $film = new Prodotto();
        $film->setId($row['film_id']);
        $film->setTitolo($row['film_titolo']);
        $film->setRegista($row['film_regista']);
        $film->setAnno($row['film_anno']);
        $film->setGenere($row['film_genere']);
        $film->setPrezzo($row['film_prezzo']);
        return $film;
    }

    public function cercaFilmPerId($film_id) {
        $film = array();
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if (!isset($mysqli)) {
            error_log("[cercaFilmPerId] Impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        if ($mysqli->connect_errno != 0) {
            $idErrore = $mysqli->connect_errno;
            $msg = $mysqli->connect_error;
            error_log("[getListaFilm] Errore nella connessione al server.", 0);
            //echo "Errore nella connessione $msgm, $idErrore";
            return null;
        } else {
            $stmt = $mysqli->stmt_init();
            $query = "select
film.id film_id,
film.titolo film_titolo,
film.regista film_regista,
film.anno film_anno,
film.genere film_genere,
film.prezzo film_prezzo,
from film
where film.id = ?";
            $stmt->prepare($query);
            if (!$stmt) {
                error_log("[caricaUtente] Impossibile inizializzare il prepared statement");
                $mysqli->close();
                return null;
            }
            if (!$stmt->bind_param('i', $film_id)) {
                error_log("[cercaFilmPerId] Impossibile effettuare il binding in input");
                $mysqli->close();
                return $film;
            }
            $film = self::caricaFilmDaStmt($stmt);
            if (count($film > 0)) {
                $mysqli->close();
                return $film[0];
            } else {
                $mysqli->close();
                return null;
            }
        }
    }

    private function &caricaFilmDaStmt(mysqli_stmt $stmt) {
        $film = array();
        if (!$stmt->execute()) {
            error_log("[caricaFilmDaStmt] Impossibile eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['film_id'], $row['film_titolo'], $row['film_regista'], $row['film_anno'], $row['film_genere'], $row['film_prezzo']);
        if (!$bind) {
            error_log("[caricaFilmDaStmt] Impossibile effettuare il binding in output");
            return null;
        }
        while ($stmt->fetch()) {
            $film[] = self::creaFilmDaArray($row);
        }
        $stmt->close();
        return $film;
    }

    public function cancella(Film $film) {
        $query = "delete from film where id = ?";
        return $this->modificaDB($film, $query);
    }

    private function modificaDB(Film $film, $query) {
        $mysqli = new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user, Settings::$db_password, Settings::$db_name);
        if ($mysqli->errno != 0) {
            return null;
        }
        if (!isset($mysqli)) {
            error_log("[modificaDB] Impossibile inizializzare il database");
            return 0;
        }
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[modificaDB] Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }
        if (!$stmt->bind_param('i', $film->getId())) {
            error_log("[modificaDB] Impossibile effettuare il binding in input");
            $mysqli->close();
            return 0;
        }
        if (!$stmt->execute()) {
            error_log("[modificaDB] Impossibile eseguire lo statement");
            $mysqli->close();
            return 0;
        }
        $mysqli->close();
        return $stmt->affected_rows;
    }

}
