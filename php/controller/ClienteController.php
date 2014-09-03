<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';
include_once basename(__DIR__) . '/../model/Film.php';
include_once basename(__DIR__) . '/../model/FilmFactory.php';

/**
 * Controller del cliente
 */
class ClienteController extends BaseController {

    /**
     * Costruttore
     */
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
            // Cliente da servire ed imposto il descrittore
            // della vista per caricare i "pezzi" delle pagine corretti
            // tutte le variabili che vengono create senza essere utilizzate
            // direttamente in questo switch, sono quelle che vengono poi lette
            // dalla vista, ed utilizzano le classi del modello
            if (isset($request["subpage"])) {
                switch ($request["subpage"]) {
                 
                    // visualizzazione dei noleggi richiesti
                    case 'noleggi':
                        $noleggi = NoleggioFactory::instance()->noleggiPerCliente($user);
                        $vd->setSottoPagina('noleggi');
                        break;                    
                    //visualizzazione dell'elenco dei film
                    case 'film':
                        $film = FilmFactory::instance()->getFilm();
                        $vd->setSottoPagina('ListaFilm');
                        break;
                    default:
                        $vd->setSottoPagina('Home');
                        break;
                }
            }
            //Gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {
                //Abbiamo ricevuto un comando
                switch ($request["cmd"]) {
                    //Logout
                    case 'logout':
                        $this->logout($vd);
                        break;
                }
            }
        }

        //Includo la vista
        require basename(__DIR__) . '/../view/master.php';
    }
}

?>