<?php
    // Funkcja pokazująca podstronę z bazy danych
    // na podstawie danego linku do bazy i id strony
    // lub zwraca odpowiedni błąd
    function pokazPodstrone($id, $link) {
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

    // funkcja sprawdza poprawność id
    // true jeśli id poprawne (jest liczbą & jest liczbą całkowitą & nieujemną)
    function isCorrectId($id) {
        if(is_numeric($id) && is_int($id + 0) && $id >= 0)
            return true;
        return false;
    }
?>
