<?php
switch ($vd->getSottoPagina()) {
    case 'lista':
        include 'lista.php';
        break;
    case 'noleggi':
        include 'noleggi.php';
        break;
        ?>

        <p>
            Benvenuto, <?= $user->getNome() ?>
        </p>
        <p>
            Scegli una fra le seguenti sezioni:
        </p>
        <ul>            
            <li><a href="cliente/lista">Lista Film</a></li>
            <li><a href="cliente/noleggi">Noleggi</a></li>
        </ul>
        <?php
        break;
}
?>