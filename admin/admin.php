<?php

function FormularzLogowania() {
    $wynik = '
    <div id="login-form" class="container vertical">
        <form method="POST" name="login-form" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <fieldset>
            <div class="container vertical form-item">
            Login<br>
            <input name="login" type="text" id="imie"><br>
            Hasło<br>
            <input name="password" type="password" id="nazwisko"><br>
            <input class="btn" style="margin-top: 10px" type="submit" value="Zaloguj">
            </div>
        </fieldset>
        </form>
    </div>
    ';
    return $wynik;
}

function ListaPodstron() {
    include('cfg.php');
    $query = 'SELECT * FROM page_list ORDER BY id DESC LIMIT 100';
    $result = mysqli_query($link, $query);
    $return = '<table id="page-list">
        <tr>
            <th>
                ID
            </th><th style="width: 300px; min-width: fit-content">
                Tytuł
            </th><th>
                Status
            </th>
        </tr>';
    while($row = mysqli_fetch_array($result)) {
        $return = $return.'<tr><td>'.$row['id'].'</td><td>'.$row['page_title'].'</td><td>'.$row['status'].'</td></tr>';
    }
    $return = $return.'</table>';
    return $return;
}

function ControlPanel() {
    include('cfg.php');
    if($_POST['login'] == $login && $_POST['password'] == $password) {
        return ListaPodstron();
    } else {
        return FormularzLogowania();
    }
}

?>
