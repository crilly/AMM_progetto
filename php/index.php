<?php

include_once 'controller/BaseController.php';
include_once 'controller/ClienteController.php';
require_once 'controller/VenditoreController.php';
date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
FrontController::dispatch($_REQUEST);

/**
 * Classe che controlla il punto unico di accesso all'applicazione
 * @author Davide Spano
 */
class FrontController {

    /**
     * Gestore delle richieste al punto unico di accesso all'applicazione
     * @param array $request i parametri della richiesta
     */
    public static function dispatch(&$request) {
        //Inizializziamo la sessione
        session_start();
        if (isset($request["page"])) {
            switch ($request["page"]) {
                case "login":
                    //La pagina di login e' accessibile a tutti,
                    //la facciamo gestire al BaseController
                    $controller = new BaseController();
                    $controller->handleInput($request);
                    break;
                // cliente
                case 'cliente':
                    $controller = new ClienteController();
                    if (isset($_SESSION[BaseController::role]) &&
                            $_SESSION[BaseController::role] != User::Cliente) {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;
                // venditore
                case 'venditore':
                    $controller = new VenditoreController();
                    if (isset($_SESSION[BaseController::role]) &&
                            $_SESSION[BaseController::role] != User::Venditore) {
                        self::write403();
                    }
                    $controller->handleInput($request);
                    break;
                default:
                    self::write404();
                    break;
            }
        } else {
            self::write404();
        }
    }

    /**
     * Crea una pagina di errore quando il path specificato non esiste
     */
    public static function write404() {
        //Impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 404 Not Found');
        $titolo = "File non trovato!";
        $messaggio = "La pagina che hai richiesto non &egrave; disponibile";
        exit();
    }

    /**
     * Crea una pagina di errore quando l'utente non ha i privilegi
     * per accedere alla pagina
     */
    public static function write403() {
        //Impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 403 Forbidden');
        $titolo = "Accesso negato";
        $messaggio = "Non hai i diritti per accedere a questa pagina";
        $login = true;
        exit();
    }
}

?>