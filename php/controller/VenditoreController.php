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
                            $vd->setSottoPagina('parco_auto');
                            if (VeicoloFactory::instance()->nuovo($nuovo) != 1) {
                                $msg[] = '<li> Impossibile creare il veicolo </li>';
                            }
                        }
                        $this->creaFeedbackUtente($msg, $vd, "Veicolo creato");
                        $veicoli = VeicoloFactory::instance()->getVeicoli();
                        $this->showHomeUtente($vd);
                        break;
// cancella un veicolo
                    case 'cancella_veicolo':
                        if (isset($request['veicolo'])) {
                            $intVal = filter_var($request['veicolo'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if (isset($intVal)) {
                                if (VeicoloFactory::instance()->cancellaPerId($intVal) != 1) {
                                    $msg[] = '<li> Impossibile cancellare il veicolo </li>';
                                }
                                $this->creaFeedbackUtente($msg, $vd, "Veicolo eliminato");
                            }
                        }
                        $veicoli = VeicoloFactory::instance()->getVeicoli();
                        $this->showHomeUtente($vd);
                        break;
// default
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
// nessun comando, dobbiamo semplicemente visualizzare
// la vista
// nessun comando
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }
// richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

    /**
     * Aggiorna i dati relativi ad un appello in base ai parametri specificati
     * dall'utente
     * @param Appello $mod_appello l'appello da modificare
     * @param array $request la richiesta da gestire
     * @param array $msg array dove inserire eventuali messaggi d'errore
     */
    private function updateAppello($mod_appello, &$request, &$msg) {
        if (isset($request['insegnamento'])) {
            $insegnamento = InsegnamentoFactory::instance()->creaInsegnamentoDaCodice($request['insegnamento']);
            if (isset($insegnamento)) {
                $mod_appello->setInsegnamento($insegnamento);
            } else {
                $msg[] = "<li>Insegnamento non trovato</li>";
            }
        }
        if (isset($request['data'])) {
            $data = DateTime::createFromFormat("d/m/Y", $request['data']);
            if (isset($data) && $data != false) {
                $mod_appello->setData($data);
            } else {
                $msg[] = "<li>La data specificata non &egrave; corretta</li>";
            }
        }
        if (isset($request['posti'])) {
            if (!$mod_appello->setCapienza($request['posti'])) {
                $msg[] = "<li>La capienza specificata non &egrave; corretta</li>";
            }
        }
    }

    /**
     * Ricerca un apperllo per id all'interno di una lista
     * @param int $id l'id da cercare
     * @param array $appelli un array di appelli
     * @return Appello l'appello con l'id specificato se presente nella lista,
     * null altrimenti
     */
    private function cercaAppelloPerId($id, &$appelli) {
        foreach ($appelli as $appello) {
            if ($appello->getId() == $id) {
                return $appello;
            }
        }
        return null;
    }

    /**
     * Calcola l'id per un nuovo appello
     * @param array $appelli una lista di appelli
     * @return int il prossimo id degli appelli
     */
    private function prossimoIdAppelli(&$appelli) {
        $max = -1;
        foreach ($appelli as $a) {
            if ($a->getId() > $max) {
                $max = $a->getId();
            }
        }
        return $max + 1;
    }

    /**
     * Restituisce il prossimo id per gli elenchi degli esami
     * @param array $elenco un elenco di esami
     * @return int il prossimo identificatore
     */
    private function prossimoIndiceElencoListe(&$elenco) {
        if (!isset($elenco)) {
            return 0;
        }
        if (count($elenco) == 0) {
            return 0;
        }
        return max(array_keys($elenco)) + 1;
    }

    /**
     * Restituisce l'identificatore dell'elenco specificato in una richiesta HTTP
     * @param array $request la richiesta HTTP
     * @param array $msg un array per inserire eventuali messaggi d'errore
     * @return l'identificatore dell'elenco selezionato
     */
    private function getIdElenco(&$request, &$msg) {
        if (!isset($request['elenco'])) {
            $msg[] = "<li> Non &egrave; stato selezionato un elenco</li>";
        } else {
// recuperiamo l'elenco dalla sessione
            $elenco_id = filter_var($request['elenco'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            if (!isset($elenco_id) || !array_key_exists($elenco_id, $_SESSION[self::elenco]) || $elenco_id < 0) {
                $msg[] = "L'elenco selezionato non &egrave; corretto</li>";
                return null;
            }
            return $elenco_id;
        }
        return null;
    }

    /**
     * Restituisce l'appello specificato dall'utente tramite una richiesta HTTP
     * @param array $request la richiesta HTTP
     * @param array $msg un array dove inserire eventuali messaggi d'errore
     * @return Appello l'appello selezionato, null se non e' stato trovato
     */
    private function getAppello(&$request, &$msg) {
        if (isset($request['appello'])) {
            $appello_id = filter_var($request['appello'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            $appello = AppelloFactory::instance()->cercaAppelloPerId($appello_id);
            if ($appello == null) {
                $msg[] = "L'appello selezionato non &egrave; corretto</li>";
            }
            return $appello;
        } else {
            return null;
        }
    }

}

?>