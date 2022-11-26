<?php
    // $link, konfiguracja bazy danych
    include('cfg.php');

    include('showpage.php');

    // pokaż błędy do debugowania
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    set_include_path('html');

    // id stron domyślnych
    $index = '1';
    $header = '6';
    $nav = '2';
    // informacja lub id strony 404
    // $notfound = '';

    // wyświetla index gdy id puste lub jest podstroną z elementami nawigacyjnymi
    if($_GET['id'] && $_GET['id'] != $header && $_GET['id'] != $nav) {
        $content = $_GET['id'];
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
        <script src="js/script.js"></script>
        <script src="js/jquery-3.6.1.min.js"></script>
        <script src="js/anim.js"></script>
        <link rel="icon" type="image/x-icon" href="img/icon.png">
    </head>
    <body onload="showtime(), setcolors()">
    <a name="top"></a>
        <div class="container vertical" id="fullscreen">
            <div class="container horizontal pad" id="header">
                <?= pokazPodstrone($header, $link) ?>
            </div>
            <div class="container horizontal" id="main">
                <div class="container vertical pad" id="nav">
                    <?= pokazPodstrone($nav, $link) ?>
                </div>
                <div id="content">
                    <?php
                        echo pokazPodstrone($content, $link);
                        echo '<br><br>';
                        echo $podpis;
                    ?>
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
