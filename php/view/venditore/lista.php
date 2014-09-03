<h2>Lista Film</h2>
<table>
    <tr>
        <th>Titolo</th>
        <th>Regista</th>
        <th>Anno</th>
        <th>Genere</th>
        <th>Prezzo</th>
        <th>Prenota</th>
    </tr>
    <?
    foreach ($film as $Film) {
    ?>
    <tr>
        <td><?= $film->getTitolo() ?></td>
        <td><?= $film->getRegista() ?></td>
        <td><?= $film->getAnno() ?></td>
        <td><?= $film->getGenere() ?></td>
        <td><?= $film->getPrezzo() . " €/giorno" ?></td>
        <td><a href="cliente/prenotaFilm<?= $film->getId() ?>" title="Noleggia il film">
    </tr>
    <? 
    } 
    ?>
</table>