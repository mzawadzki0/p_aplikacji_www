<?php
    // Rozpocznij sesję
    session_start();
    if (!isset($_SESSION['login_failed']))
        $_SESSION['login_failed'] = false;
    if (!isset($_SESSION['logged_in']))
        $_SESSION['logged_in'] = false;

    // funkcja pokazPodstrone()
    include('showpage.php');

    // Pokaż błędy do debugowania
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    // Już niepotrzebne bo wszystkie html są w bazie danych
    // set_include_path('html');
    
    // $podpis, dane osobowe wykluczone z repo
    include('autor.php');
    include('mail.php');
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
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="js/anim.js"></script>
        <script src="js/scrollprogress.js"></script>
        <link rel="icon" type="image/x-icon" href="img/icon.png">
    </head>

    <body onload="showtime(), setcolors()">
        <a name="page-top"></a>
        <div id="scrollprogress"></div>

        <div class="container vertical" id="fullscreen">
            <div class="container horizontal pad" id="header">
                <?= pokazPodstrone($header, $link) ?>
            </div>

            <div class="container horizontal" id="main">
                <div class="container vertical pad" id="nav">
                    <?= pokazPodstrone($nav, $link) ?>
                </div>

                <div class="container vertical" id="content">
                    <?= $content ?>

                    <a class="container horizontal" id="scroll-to-top" href="#page-top">
                        <svg height="41" width="41">
                            <polygon points="20,10 8,27 32,27" stroke-width="2" fill="#00b0ff" />
                        </svg> 
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
