<?php

include_once 'BaseController.php';

class ClienteController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function handleInput(&$request) {
        $vd = new ViewDescriptor();
        $vd->setPagina($request['page']);
        if (!$this->loggedIn()) {
            //Utente non autenticato, rimando alla home
            $this->showLoginPage($vd);
        } else {
            //Utente autenticato
            $user = UserFactory::instance()->cercaUtentePerId(
                    $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
            //Gestione dei comandi inviati dall'utente
            if (isset($request["cmd"])) {
                switch ($request["cmd"]) {
                    
                    case 'logout':
                        $this->logout($vd);
                        break;
                    
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }
            } else {
                //Nessun comando
                $user = UserFactory::instance()->cercaUtentePerId(
                        $_SESSION[BaseController::user], $_SESSION[BaseController::role]);
                $this->showHomeUtente($vd);
            }
        }
        //Richiamo la vista
        require basename(__DIR__) . '/../view/master.php';
    }

}
