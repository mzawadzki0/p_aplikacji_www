<?php
    // $link, konfiguracja bazy danych
    include('cfg.php');
    include('admin/admin.php');
    include('showpage.php');

    // pokaż błędy do debugowania
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    set_include_path('html');

    // id stron domyślnych
    $index = ControlPanel();

    // wyświetla index gdy id puste
    if($_GET['id']) {
        $content = pokazPodstrone($_GET['id'], $link);
    } else
        $content = $index;
    
    // $podpis
    include('autor.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Największe mosty świata</title>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="Content-Language" content="pl" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <link type="text/css" rel="stylesheet" href="css/forms.css" />
        <script src="js/script.js"></script>
        <script src="js/jquery-3.6.1.min.js"></script>
        <script src="js/anim.js"></script>
        <link rel="icon" type="image/x-icon" href="img/icon.png">
    </head>
    <body onload="showtime(), setcolors()">
    <a name="top"></a>
        <div class="container vertical" id="fullscreen">
            <div class="container horizontal pad" id="header">
                <a href="?" >
                    <div id="icon">
                        <img src="img/icon.png">
                    </div>
                </a>
                <div>
                    <h3>Największe mosty świata</h3>
                    <h4>Galeria | Lista największych mostów na świecie</h4>
                </div>
                <div id="settings">
                    <div>
                        <input type="color" id="textcol" name="text" value="#ebebde">
                        <label for="text">Tekst</label>
                        <input type="color" id="bgcol" name="bg" value="#1a1a1a">
                        <label for="bg">Tło</label>
                    </div>
                    <div id="colswitch" class="pointer" onclick="switchcolors()">
                        Zmień kolor
                    </div>
                </div>
                <div id="header-item-right">
                    <div id="time"></div>
                    <div id="date"></div>
                    <div>
                        <a href="?p=form.html">
                            Formularz
                        </a>
                    </div>
                    <div>
                        <u><a href="mailto:macioz5621@gmail.com">Kontakt</a></u>
                    </div>
                </div>
            </div>
            <div class="container horizontal" id="main">
                <div class="container vertical pad" id="nav">
                    <a href="?">
                        <div class="nav-item pad">
                            Strona główna
                        </div>
                    </a>
                    <a href="?id=1">
                        <div class="nav-item pad">
                            Galeria
                        </div>
                    </a>
                    <a href="?id=7">
                        <div class="nav-item pad">
                            Filmy
                        </div>
                    </a>
                    <a href="?id=3">
                        <div class="nav-item pad">
                            Most cieśniny Akashishi
                        </div>
                    </a>
                    <a href="?id=4">
                        <div class="nav-item pad">
                            Most na wyspie Rousski
                        </div>
                    </a>
                    <a href="?id=5">
                        <div class="nav-item pad">
                            Pontchartrain
                        </div>
                    </a>
                    <a href="?id=8">
                        <div class="nav-item pad">
                            Kontakt
                        </div>
                    </a>
                    <a href="?id=9">
                        <div class="nav-item pad">
                            jQuery
                        </div>
                    </a>
                </div>
                <div id="content">
                    <?= $content ?>
                    <div style="display: block; margin-left: auto; text-align: end;"><a href="#top">
                        <svg height="40" width="40">
                            <circle cx="20" cy="20" r="19" stroke="#00b0ff" stroke-width="2" fill-opacity="0%" />
                            <polygon points="20,10 8,27 32,27" stroke-width="2" fill="#00b0ff" />
                        </svg> 
                    </a></div>
                </div>
            </div>
        </div>
    </body>
</html>
