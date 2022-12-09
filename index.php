<?php
    // Rozpocznij sesję
    session_start();
    if (!isset($_SESSION['login_failed']))
        $_SESSION['login_failed'] = false;
    if (!isset($_SESSION['logged_in']))
        $_SESSION['logged_in'] = false;

    // $link, konfiguracja bazy danych
    include('cfg.php');

    // ControlPanel(), formularz logowania i inne dostępne po zalogowaniu
    // wszystko pod adresem http://host/./?
    include('admin/admin.php');

    // funkcja pokazPodstrone()
    include('showpage.php');

    // Pokaż błędy do debugowania
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    // Już niepotrzebne bo wszystkie html są w bazie danych
    // set_include_path('html');

    // treść strony wyświetlana domyślnie
    $index = ControlPanel();

    // id stron nawigacji i domyślnej strony z treścią
    // powinny być niedostępne do wyświetlenia jako treść strony
    // header zawiera tytuł strony, ikonę, zegar, form wyboru i zmiany kolorów strony, zegar, link do formularza kontaktu, link mailto
    $header = 6;
    $nav = 2;

    // wyświetla index gdy id puste
    if($_GET['id'] && $_GET['id'] != $nav && $_GET['id'] != $header) {
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
    <a name="page-top"></a>
        <div class="container vertical" id="fullscreen">
            <div class="container horizontal pad" id="header">
                <?= pokazPodstrone($header, $link) ?>
            </div>

            <div class="container horizontal" id="main">
                <div class="container vertical pad" id="nav">
                    <?= pokazPodstrone($nav, $link) ?>
                </div>

                <div id="content">
                    <?= $content ?>
                    <div id="scrolltotop" style="display: block; margin-left: auto; text-align: end;"><a href="#page-top">
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
