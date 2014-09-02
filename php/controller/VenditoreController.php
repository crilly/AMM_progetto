<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/Film.php';
include_once basename(__DIR__) . '/../model/FilmFactory.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';

/**
 * Controller che gestisce la modifica dei dati dell'applicazione relativa ai venditori
 *
 * @author Davide Spano
 */

class VenditoreController extends BaseController {

    const elenco = 'elenco';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Metodo per gestire l'input dell'utente.
     * @param type $request la richiesta da gestire
     */
    public function handleInput(&$request) {
        //Creo il descrittore della vista
        $vd = new ViewDescriptor();
        //Imposto la pagina
        $vd->setPagina($request['page']);
        if (!$this->loggedIn()) {
            //Utente non autenticato, rimando alla home
            $this->showLoginPage($vd);
        } else {
            //Utente autenticato
            $user = UserFactory::instance()->cercaUtentePerId(
                    $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
// verifico quale sia la sottopagina della categoria
// Venditore da servire ed imposto il descrittore
// della vista per caricare i "pezzi" delle pagine corretti
// tutte le variabili che vengono create senza essere utilizzate
// direttamente in questo switch, sono quelle che vengono poi lette
// dalla vista, ed utilizzano le classi del modello
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {

                    //visualizza elenco noleggi
                    case 'noleggi':
                        $film = FilmFactory::instance()->getFilm();
                        $clienti = UserFactory::instance()->getListaClienti();
                        $vd->setSottoPagina('noleggi');
                        break;
                    //Visualizzazione elenco film
                    case 'film':
                        $film = FilmFactory::instance()->getVeicoli();
                        $vd->setSottoPagina('lista_film');
                        break;
                    default:
                        $vd->setSottoPagina('home');
                        break;
                }
            }
            //Gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {
                switch ($request["cmd"]) {
                    //Logout
                    case 'logout':
                        $this->logout($vd);
                        break;

                    //Inserimento di un nuovo film
                    case 'nuovo_film':
                        $vd->setSottoPagina('nuovo_film');
                        $msg = array();
                        $nuovo = new Film();
                        $nuovo->setId(-1);
                        if ($request['titolo'] != "") {
                            $nuovo->setTitolo($request['titolo']);
                        } else {
                            $msg[] = '<li> Inserire un titolo valido </li>';
                        }
                        if ($request['regista'] != "") {
                            $nuovo->setRegista($request['regista']);
                        } else {
                            $msg[] = '<li> Inserire un regista valido </li>';
                        }
                        if ($request['anno'] != "") {
                            $nuovo->setAnno($request['anno']);
                        } else {
                            $msg[] = '<li> Inserire un anno valido </li>';
                        }
                        if ($request['genere'] != "") {
                            $nuovo->setGenere($request['genere']);
                        } else {
                            $msg[] = '<li> Inserire un genere valido </li>';
                        }
                        if (count($msg) == 0) {
                            $vd->setSottoPagina('lista_film');
                            if (FilmFactory::instance()->nuovo($nuovo) != 1) {
                                $msg[] = '<li> Impossibile aggiungere il film </li>';
                            }
                        }
                        $this->creaFeedbackUtente($msg, $vd, "Film aggiunto");
                        $film = FilmFactory::instance()->getFilm();
                        $this->showHomeUtente($vd);
                        break;
                    //Default
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
                //Nessun comando, dobbiamo semplicemente visualizzare la vista
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }
        //Richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

    /**
     * Calcola l'id per un nuovo film
     * @param array $film una lista di film
     * @return int il prossimo id del film
     */
    private function prossimoIdFilm(&$film) {
        $max = -1;
        foreach ($film as $a) {
            if ($a->getId() > $max) {
                $max = $a->getId();
            }
        }
        return $max + 1;
    }

    /**
     * Restituisce l'appello specificato dall'utente tramite una richiesta HTTP
     * @param array $request la richiesta HTTP
     * @param array $msg un array dove inserire eventuali messaggi d'errore
     * @return Appello l'appello selezionato, null se non e' stato trovato
     */
    private function getFilm(&$request, &$msg) {
        if (isset($request['film'])) {
            $film_id = filter_var($request['film'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            $film = FilmFactory::instance()->cercaFilmPerId($film_id);
            if ($film == null) {
                $msg[] = "Il film selezionato non &egrave; corretto</li>";
            }
            return $film;
        } else {
            return null;
        }
    }
}

?>