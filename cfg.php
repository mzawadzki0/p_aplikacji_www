<?php
    // Dane bazy danych
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'p_aplikacji_www';

    // Łączenie z bazą
    $link = mysqli_connect($dbhost, $dbuser, $dbpass);
    if(!$link) echo '<b>przerwane połączenie</b>';
    if(!mysqli_select_db($link, $baza)) echo 'nie wybrano bazy';

    // Dane logowania
    $login = 'maciej';
    $password = '1234'
?>
