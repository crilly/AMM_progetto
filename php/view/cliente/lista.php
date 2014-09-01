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
    foreach ($veicoli as $veicolo) {
    ?>
    <tr>
        <td><?= $veicolo->getModello()->getCostruttore()->getNome() ?></td>
        <td><?= $veicolo->getModello()->getNome() ?></td>
        <td><?= $veicolo->getTarga() ?></td>
        <td><?= $veicolo->getAnno() ?></td>
        <td><?= $veicolo->getModello()->getPotenza() . " cv" ?></td>
        <td><?= $veicolo->getModello()->getCilindrata() . " cm<sup>3</sup>" ?></td>
        <td><?= $veicolo->getModello()->getPrezzo() . " €/giorno" ?></td>
        <td><a href="cliente/veicoli?cmd=prenota&veicolo=<?= $veicolo->getId() ?>" title="Prenota il veicolo">
                <img src="../img/prenota.png" alt="Prenota"></a></td>
    </tr>
    <? } ?>
</table>