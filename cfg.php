<?php
    // Dane bazy danych
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'p_aplikacji_www';

    // Łączenie z bazą
    $link = mysqli_connect($dbhost, $dbuser, $dbpass);

    // Komunikaty błędu
    if(mysqli_connect_errno()) echo '<div class="errormsg">Błąd podczas łączenia z bazą: </div>'.mysqli_connect_error().'<br>';
    if(!$link) echo '<h3> class="errormsg" >przerwane połączenie</h3><br>';
    if(!mysqli_select_db($link, $baza)) echo '<h3 class="errormsg">Nie wybrano bazy</h3><br>';

    // Dane logowania admina
    $login = 'maciej';
    $password = '1234'
?>
