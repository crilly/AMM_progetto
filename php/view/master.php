<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../php/Settings.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <title><?= $vd->getTitolo() ?></title>
        <base href="<?= Settings::getApplicationPath() ?>php/"/>
        <link href="../css/stile.css" rel="stylesheet" type="text/css"/>
        <link type="image/x-icon" href="../immagini/titolo.png" />
        <!--<script type="text/javascript" src="../js/ajax.js"></script>-->
    </head>
    <body>
        <div id="page">
            
            <div id="header">
                <?php
                $logo = $vd->getLogoFile();
                require "$header";
                ?>
            </div>
            
            <div id="menu">
                <?php
                $menu = $vd->getMenuFile();
                require "$menu";
                ?>
            </div>

            <div id="content">
                <?php
                $content = $vd->getContentFile();
                require "$content";
                ?>
            </div>
            
            <div id="footer">
                <h6>Progetto di Amministrazione di Sistema<br/>di Cristin Sanna</h6>
                <a id="WikipediaFilm" href="https://it.wikipedia.org/wiki/Film">Wikipedia Film</a> 
                <a id="ComingSoon" href="http://www.comingsoon.it/cinema/filmalcinema/">Film al cinema</a>                
            </div>
            
        </div>
    </body>
</html>