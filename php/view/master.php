<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../settings.php';
?>

    <!DOCTYPE html>

    <html>

        <head>   
            <title><?= $vd->getTitolo() ?></title>
            <base href="<?= Settings::getApplicationPath() ?>php/"/>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" type="text/css" href="../css/stile.css">           

        </head>

        <body>
            <div id="page">

                <div id="header">
                    <?php
                    $logo = $vd->getLogoFile();
                    require "$logo";
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
                <a id="wikipedia" href="https://it.wikipedia.org/wiki/Film">Film Wikipedia</a>
                <a id="comingsoon" href="http://www.comingsoon.it/cinema/filmalcinema/">Film al cinema</a>
            </div>
        </div>
    </body>
</html>

