<h1>Elenco noleggi</h1>

<table id="noleggi">
    <thead>
        <tr>
            <th>Film</th>
            <th>Cliente</th>
            <th>Inizio Noleggio</th>
            <th>Fine Noleggio</th>
            <th>Totale</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($noleggi as $noleggio) { ?>
        <tr>
            <td><?= $noleggio->getFilm() ?></td>
            <td><?= $noleggio->getCliente() ?></td>
            <td><?= $noleggio->getInizioNoleggio() ?></td>
            <td><?= $noleggio->getFineNoleggio() ?></td>
            <td><?= $noleggio->getTotale() ?> €</td>
        </tr>
        <? } ?>
    </tbody>
</table>