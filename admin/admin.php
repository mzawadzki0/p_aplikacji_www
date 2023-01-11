<?php

// Funkcja odświerzająca stronę
function RefreshPage() {
    // Failsafe
    // echo "<meta http-equiv='refresh' content='0'>";

    // Przekierowanie z informacją dla przeglądarki żeby nie pokazywać "Wyślij ponownie" po wysłaniu formularza
    // 303 See other
    header('Location: ', true, 303);
}

// Formularz logowania z polami login, hasło
function FormularzLogowania() {
    $return = '
    <div class="container vertical form">
        <form method="POST" name="login-form" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <fieldset>
            <div class="container vertical form form-item">
            Login<br>
            <input name="login" type="text" id="imie"><br>
            Hasło<br>
            <input name="password" type="password" id="nazwisko"><br>
            <input class="btn goodbtn" style="margin-top: 10px" type="submit" value="Zaloguj">
            </div>
        </fieldset>
        </form>
    </div>
    ';
    return $return;
}

// Strona główna
// Zawiera wszystkie funkcje użytkownika zalogowanego
function ControlPanel() {
    // Potrzebna zmienna $link do zapytań, $hostname do headerów w mailach
    include('cfg.php');

    // Wiadomość o nieudanym logowaniu
    $login_failed_msg = '
    <div class="container vertical form">
        <h4 class="errormsg">Niepoprawne dane logowania</h4>
    </div>';
    
    // Przycisk "Wyloguj"
    $logout_btn = ' 
    <form method="POST" name="logout-form" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
    <input class="btn evilbtn" type="submit" name="logout" value="Wyloguj">
    </form>
    ';

    // Wynik funkcji, wszystko co ma trafić do returna
    // Wartość wpisana tutaj jest wyświetlana jako placeholder gdy nie ma nic innego
    // np. po wylogowaniu ale przed odświeżeniem strony
    $return = 'ładowanie...<br>(jeśli trwa dłużej niż sekundę to coś jest nie tak)';

    // Nawigacja po panelu admina
    $links_list = '<div><form method="GET" action="'.$_SERVER['REQUEST_URI'].'">
    <button class="btn neutralbtn" name="manage_products">Zarządzaj produktami</button>
    <button class="btn neutralbtn" name="manage_categories">Zarządzaj kategoriami</button>
    <button class="btn neutralbtn" name="manage_webpages">Zarządzaj podstronami</button>
    </form></div>
    ';

    // Wszystkie funkcje dostępne dla admina zalogowanego
    // Domyślnie wyświetla listę funkcji, po kliknięciu podfunkcję
    // wszystkie podfunkcje w zewnętrznych plikach w /admin/
    if($_SESSION['logged_in'] === true || isset($_POST['password']) && isset($_POST['login']) && isset($_POST['password']) && ($_POST['login'] === $login && $_POST['password'] === $password)) {

        // Reset zmiennej nieudanego logowania
        $_SESSION['login_failed'] = false;

        // Zapisanie stanu logowania (tzn. zalogowano) dla sesji
        $_SESSION['logged_in'] = true;

        // Funkcje zalogowanego admina

        // Obsługa przycisku "Wyloguj"
        if(isset($_POST['logout'])) {
            $_SESSION['logged_in'] = false;
            RefreshPage();
        
        // Obsługa zarządzania produktami
        } else if(isset($_GET['manage_products'])) {
            include('admin/products.php');
            $return = $links_list.Products();
        
        // Obsługa zarządzania kategoriami produktów
        } else if(isset($_GET['manage_categories'])) {
            include('admin/product_categories.php');
            $return = $links_list.Categories();

        // Obsługa zarządzania podstronami w bazie
        } else if(isset($_GET['manage_webpages'])) {
            include('admin/pages.php');
            $return = $links_list.Pages();
        } else {
            $return = $links_list;
        }

        // Przycisk wyloguj na każdej stronie jeśli zalogowano
        $return .= $logout_btn;
        
    } else {
        // Funkcja PrzypomnijHaslo
        include('contact.php');

        // Funkcje dostępne przed zalogowaniem
        if($_SESSION['login_failed'] === false) {
            // Pierwsze wyświetlenie formularza
            // bez wiadomości o nieudanym logowaniu
            $_SESSION['login_failed'] = true;

            // Przypomnienie hasła; z contact.php
            $return = FormularzLogowania().PrzypomnijHaslo();
        } else {
            if(!isset($_POST['password']) && !isset($_POST['login']))
                $return = FormularzLogowania().PrzypomnijHaslo();
            else
                // Jeśli zostały wprowadzone dane, ale nie powiodło się logowanie
                // jest wyświetlana wiadomość o nieudanym logowaniu
                $return = FormularzLogowania().PrzypomnijHaslo().$login_failed_msg;
        }
    }
    return $return;
}

?>
