<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Progetto di Amministrazione di Sistema</title>
    </head>
    <body>
        <h1>Link al progetto</h1>
        <p>
            <a href="http://spano.sc.unica.it/amm2014/sannaCristin/site">Login</a>
        </p>
        <p>
        <h3>Descrizione</h3>
        L'applicazione simula una videoteca dalla quale è possibile noleggiare dei film. Gli utenti sono divisi in amministratori e clienti.</br>
        Gli amministratori possono:
        <ul>
            <li>Visualizzare l'elenco dei film</li>
            <li>Aggiungere film</li>
            <li>Rimuovere film</li>
            <li>Visualizzare lo storico prenotazioni di tutti gli utenti</li>
            <li>Cancellare gli utenti</li>
        </ul>
        I clienti possono:
        <ul>
            <li>Visualizzare l'elenco dei film</li>
            <li>Registrare un noleggio</li>
            <li>Visualizzare lo storico dei propri noleggi</li>
        </ul>
    </p>
    <p>
    <h3>Note:</h3>
    <ol>
        <li>Implementazione del sistema di registrazione</li>
        <li>Nel caso in cui si effettui l'accesso con l'user admin, cliccando sul codice del film, questo non verrà prenotato ma eliminato.</li> 
        <li>Nel caso in cui si effettui l'accesso con l'user admin, cliccando sul codice dell'utente, questo verrà eliminato. </li>
        <li>Nel caso in cui si effettui l'accesso con l'user admin, cliccando sul codice della prenotazione, questa verrà eliminata. </li>
    </ol>
</p>

<p>
<h3>Requisiti soddisfatti</h3>
<ol>
    <li>Utilizzo di HTML e CSS</li>
    <li>Utilizzo di PHP e MySQL</li>
    <li>Due ruoli (cliente e amministratore)</li>
    <li>Transazione per il salvataggio di un nuovo noleggio (nelle pagine prenota.php / verifica_prenotazione.php)</li>
    <li>Contenuto AJAX nella pagina iniziale (testo animato, nel file testoiniziale.php)</li>
</ol>
</p>
<p>
<h3>Utenti</h3>
<ul>
    <li>Cliente
        <ul>
            <li>username: cristin</li>
            <li>password: 0000</li>
        </ul>
    </li>
    </br>
    <li>Amministratore
        <ul>
            <li>username: admin</li>
            <li>password: admin</li>
        </ul>
    </li>
</ul>
</p>
</body>
</html>