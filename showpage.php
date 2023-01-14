<?php

    // id stron nawigacji i domyślnej strony z treścią
    // powinny być niedostępne do wyświetlenia jako treść strony
    // header zawiera tytuł strony, ikonę, zegar, form wyboru i zmiany kolorów strony, zegar, link do formularza kontaktu, link mailto
    $header = 6;
    $nav = 2;

    // Podstrona i funkcje sklepu
    if(isset($_GET['shop'])) {
        include('shop.php');
        $content = Shop();
    
    // Funkcje PokazKontakt() itp. formularze kontaktowe
    } else if(isset($_GET['contact_form'])) {
        include('contact.php');
        $content = PokazKontakt();

    // Wyświetla index gdy id puste
    } else if(isset($_GET['page']) && $_GET['page'] != $nav && $_GET['page'] != $header) {
        $content = pokazPodstrone($_GET['page']);
    } else {
        // ControlPanel(), formularz logowania i inne dostępne po zalogowaniu
        // wszystko pod adresem http://host/./?
        include('admin/admin.php');
        $content = ControlPanel();
    }

    // Funkcja pokazująca podstronę z bazy danych
    // na podstawie danego linku do bazy i id strony
    // lub zwraca odpowiedni błąd
    function pokazPodstrone($id) {
        // $link, konfiguracja bazy danych
        include('cfg.php');

        // Zwracane w przypadku kiedy strona nieaktywna (status==0)
        $status_zero_msg = '<h3 class="errormsg" >Strona nieaktywna!</h3>';

        // Sprawdzenie poprawności id
        
        if(!isCorrectId($id)) {
            return '<h3 class="errormsg" >Niepoprawne id strony!</h3>';
        }

        // ochrona przed SQL injection
        $id_clear = htmlspecialchars($id);
        
        // Zapytanie wybierające stronę o danym id
        $query = 'SELECT * FROM page_list WHERE id='.$id_clear.' LIMIT 1';
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);

        // Błąd gdy id nie istnieje w bazie
        if(empty($row['id'])) {
            $web = '<h3 class="errormsg" >Nie znaleziono strony!</h3>';
        } else {
            // W przypadku kiedy status==0
            if($row['status'] == 0)
                $web = $status_zero_msg;
            else
                $web = $row['page_content'];
        }

        return $web;
    }
?>
