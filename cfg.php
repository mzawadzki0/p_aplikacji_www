<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'p_aplikacji_www';

    $link = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$link) echo '<b>przerwane połączenie</b>';
    if(!mysqli_select_db($link, $baza)) echo 'nie wybrano bazy';

    $login = 'maciej';
    $password = '1234'
?>
