<?php

/**
 * Classe che rappresenta un generico utente del sistema
 */
class User {

    //Costante che definisce il ruolo cliente     
    const Cliente = 1;
    //Costante che definisce il ruolo venditore
    const Venditore = 2;

    //Username per l'autenticazione
    private $username;
    //Password per l'autenticazione
    private $password;
    //Nome utente
    private $nome;
    //Cognome utente
    private $cognome;
    //ID utente
    private $id;

    /**
     * Il ruolo dell'utente nell'applicazione.
     * Lo utilizzo per implementare il controllo degli accessi
     * @var int
     */
    private $ruolo;

    /**
     * Costruttore
     */
    public function __construct() {
        
    }

    /**
     * Verifica se l'utente esista per il sistema
     * @return boolean true se l'utente esiste, false altrimenti
     */    
    public function esiste() {
    // implementazione di comodo, va fatto con il db
        return isset($this->ruolo);
    }

    /**
     * Restituisce lo username dell'utente
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Imposta lo username per l'autenticazione dell'utente.
     * I nomi che si ritengono validi contengono solo lettere maiuscole e minuscole.
     * La lunghezza del nome deve essere superiore a 5
     * @param string $username
     * @return boolean true se lo username e' ammissibile ed e' stato impostato,
     * false altrimenti
     */
    public function setUsername($username) {
    //Utilizzo la funzione filter var specificando un'espressione regolare
    //che implementa la validazione personalizzata
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) {
            return false;
        }
        $this->username = $username;
        return true;
    }

    /**
     * Restituisce la password per l'utente corrente
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Imposta la password per l'utente corrente
     * @param string $password
     * @return boolean true se la password e' stata impostata correttamente,
     * false altrimenti
     */
    public function setPassword($password) {
        $this->password = $password;
        return true;
    }

    /**
     * Restituisce il nome dell'utente
     * @return string
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Imposta il nome dell'utente
     * @param string $nome
     * @return boolean true se il nome e' stato impostato correttamente,
     * false altrimenti
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    /**
     * Restituisce il cognome dell'utente
     * @return string
     */
    public function getCognome() {
        return $this->cognome;
    }

    /**
     * Imposta il cognome dell'utente
     * @param string $cognome
     * @return boolean true se il cognome e' stato impostato correttamente,
     * false altrimenti
     */
    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }

    /**
     * Restituisce un intero
     * @return int
     */
    public function getRuolo() {
        return $this->ruolo;
    }

    /**
     * Imposta un ruolo per un dato utente
     * @param int $ruolo
     * @return boolean true se il valore e' ammissibile ed e' stato impostato,
     * false altrimenti
     */
    public function setRuolo($ruolo) {
        switch ($ruolo) {
            case self::Cliente:
            case self::Venditore:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }

    /**
     * Restituisce un identificatore unico per l'utente
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Imposta un identificatore unico per l'utente
     * @param int $id
     * @return boolean true se il valore e' stato aggiornato correttamente,
     * false altrimenti
     */
    public function setId($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->id = $intVal;
    }

    /**
     * Compara due utenti, verificandone l'uguaglianza logica
     * @param User $user l'utente con cui comparare $this
     * @return boolean true se i due oggetti sono logicamente uguali,
     * false altrimenti
     */
    public function equals(User $user) {
        return $this->id == $user->id &&
                $this->nome == $user->nome &&
                $this->cognome == $user->cognome &&
                $this->ruolo == $user->ruolo;
    }

}

?>