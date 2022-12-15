<?php

// Funkcja odświerzająca stronę
function RefreshPage() {
    echo "<meta http-equiv='refresh' content='0'>";
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
            <input class="btn neutralbtn" style="margin-top: 10px" type="submit" value="Zaloguj">
            </div>
        </fieldset>
        </form>
    </div>
    ';
    return $return;
}

// Funkcja wyświetlające listę podstron z opcjami edytuj, usuń, dodaj
// opcje mają value odpowiadające id danego rekordu
// edytuj: $_POST['edit_page'] = (id strony)
// usuń: $_POST['delete_page'] = (id strony)
function ListaPodstron() {
    // Potrzebna zmienna $link do zapytań
    include('cfg.php');
    
    // Zapytanie
    $query = 'SELECT * FROM page_list ORDER BY id DESC LIMIT 500';
    $result = mysqli_query($link, $query);

    // Przycisk "dodaj stronę"
    $add_page = '
    <input class="btn goodbtn" id="addpagebutton" type="submit" name="add_page" value="Dodaj stronę">
    ';


    // Treść zwracana przez funkcję
    // Tabela z wierszami zawierającymi dane podstron i przyciski edycji
    // tworzonymi przez while() 
    $return = '<div class="container vertical form form-item"><form method="POST"><fieldset>
    <div class="container vertical form form-item">
        '.$add_page.'
    </div>
    <table id="page-list">
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
        $id = $row['id'];
        $title = $row['page_title'];
        $status = $row['status'];
        // Przycisk edytuj rekord
        $edit_button = '<button type="submit" name="edit_page" value='.$id.'>edytuj</button>';

        // Przycisk usuń rekord
        $delete_button = '<button type="submit" name="delete_page" value='.$id.'>usuń</button>';
        $return = $return.'<tr><td>'.$id.'</td><td>'.$title.'</td><td>'.$status.'</td><td>'.$edit_button.'</td><td>'.$delete_button.'</td></tr>';
    }
    $return = $return.'</fieldset></table></form></div>';
    return $return;
}

// Formularz edycji podstrony
// zawiera pola: id (readonly), title, content, status
// id strony do edycji bierze z value przycisku 'edit_page' w funkcji ListaPodstron() 
function EdytujPodstrone() {
    // Zmienna $link potrzebna do zapytania
    include('cfg.php');

    // Zapytanie wybierające id tytuł status strony o danym id
    $query = 'SELECT page_title,page_content,status FROM page_list WHERE id='.$_POST['edit_page'].' LIMIT 1';
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    // Zapobiega interpretowaniu tagów HTML z wybieranej treści
    $title = htmlentities($row['page_title']);
    $content = htmlentities($row['page_content']);

    // Checkbox checked jeśli status=1
    $status = $row['status'];
    if($status == 1)
        $status = 'checked';
    else
        $status = '';

    // wysokość textarea to liczba linijek w page_content
    // nie działa dobrze dla długich linijek z powodu zawijania tekstu
    $height = substr_count($content, "\n") < 15 ? 15 : substr_count($content, "\n") + 1;

    // formularz edycji podstrony z treścią
    $return = '
    <div class="container vertical">
        <form method="POST" name="edit-form" enctype="multipart/form-data" action="'.$_REQUEST['URI'].'">
        <fieldset>
            <div class="container vertical form form-item">
                <div>
                    <label for="currentpageid">id</label>
                    <input id="currentpageid" name="edit_page" "type="number" readonly="readonly" value='.$_POST['edit_page'].'>
                </div>
                <div>
                    <label for="currentpagetitle">Tytuł</label>
                    <input type="text" id="currentpagetitle" name="page_title" value="'.$title.'">
                </div>
                Treść
                <textarea name="page_content" id="page-edit" rows='.$height.' >'.$content.'</textarea><br>
                <div>
                    <label for="aktywna">Strona aktywna</label>
                    <input type="checkbox" id="aktywna" name="page_status" '.$status.'>
                </div>
                <div>
                    <input class="btn neutralbtn" style="margin-top: 10px" type="submit" name="cancel_save" value="Anuluj">
                    <input class="btn goodbtn" style="margin-top: 10px" type="submit" name="save_page" value="Zapisz">
                </div>
            </div>
        </fieldset>
        </form>
    </div>
    ';

    // Obsługa przycisku "Anuluj"
    if(isset($_POST['cancel_save'])) {
        RefreshPage();

    // obsługa przycisku "Zapisz"
    } else if(isset($_POST['save_page'])) {
        // Wartość page_status z <input type=checkbox> jest "on" lub undefined
        // Należy zamienić na 1 lub 0
        if(isset($_POST['page_status']))
            $new_status = 1;
        else
            $new_status = 0;
        
        // Ochrona przed SQL injection
        $new_title = mysqli_real_escape_string($link, $_POST['page_title']);
        $new_content = mysqli_real_escape_string($link, $_POST['page_content']);

        // Zapytanie aktualizujące tytuł, treść i status strony
        $new_query = 'UPDATE page_list SET page_title="'.$new_title.'", page_content="'.$new_content.'", status="'.$new_status.'" WHERE id='.$_POST['edit_page']." ;";
        
        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $new_query)) {
            echo '<script>alert("Zapisano stronę");</script>';
        } else {
            echo '<script>alert("Błąd");</script>';
        }

        // odśwież stronę po wykonaniu zapytania
        // bez tego kodu, textarea pokazuje treść strony sprzed edycji
        // może jest lepszy sposób żeby to zrobić ale nie wiem jaki
        RefreshPage();
    }
    return $return;
}

// Formularz usuwania podstrony
// id strony do usunięcia bierze z value przycisku 'delete_page' w funkcji ListaPodstron() 
function UsunPodstrone() {
    // Potrzebna zmienna $link do zapytania
    include('cfg.php');

    // Zapytanie
    $query = 'SELECT id, page_title FROM page_list WHERE id='.$_POST['delete_page'].' LIMIT 1';


    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $title = $row['page_title'];
    $id = $row['id'];

    // Treść do wyświetlenia
    // id, tytuł i przyciski Potwierdź, Anuluj
    $return = '
        <div class="container vertical form">
        <form method="POST" name="delete-form" enctype="multipart/form-data" action="'.$_REQUEST['URI'].'">
        <fieldset>
        <div class="container vertical form form-item">
            <div class="errormsg">
                Nastąpi usunięcie strony:
            </div>
            <div>
                <label for="currentpageid">id</label>
                <input id="currentpageid" name="delete_page" "type="number" readonly="readonly" value='.$_POST['delete_page'].'><br>
                <label for="currentpageid">Tytuł</label>
                <input id="currentpageid" type="text" readonly="readonly" value="'.$title.'">
            </div>
            <div>
            <input class="btn neutralbtn" style="margin-top: 10px" type="submit" name="cancel_delete" value="Anuluj">
            <input class="btn evilbtn" style="margin-top: 10px" type="submit" name="confirm_delete" value="Usuń">
            </div>
        </div>
        </fieldset>
        </form>
        </div>
        ';


    // Obsługa przycisku Anuluj
    if(isset($_POST['cancel_delete'])) {
        RefreshPage();

    // Obsługa przycisku Usuń
    } else if (isset($_POST['confirm_delete'])) {
        // Zapytanie usuwające stronę
        $new_query = 'DELETE FROM page_list WHERE id='.$id.' LIMIT 1';
        
        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $new_query)) {
            echo '<script>alert("Usunięto stronę");</script>';
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }
    return $return;
}

// Funkcja dodania podstrony do bazy danych
// wyświetla formularz z wartościami title, content, status
function DodajNowaPodstrone() {
    // Zmienna $link potrzebna do zapytania
    include('cfg.php');


    $return = '
    <div class="container vertical">
        <form method="POST" name="add-form" enctype="multipart/form-data" action="'.$_REQUEST['URI'].'">
        <fieldset>
            <div class="container vertical form form-item">
                <div>
                    <label for="newpagetitle">Tytuł</label>
                    <input type="text" id="newpagetitle" name="add_page">
                </div>
                <textarea name="new_page_content" id="page-edit" rows="20" ></textarea><br>
                <div>
                    <label for="aktywna">Strona aktywna</label>
                    <input type="checkbox" id="aktywna" name="new_page_status" checked>
                </div>
                <div>
                    <input class="btn neutralbtn" style="margin-top: 10px" type="submit" name="cancel_add" value="Anuluj">
                    <input class="btn goodbtn" style="margin-top: 10px" type="submit" name="confirm_add" value="Dodaj">
                </div>
            </div>
        </fieldset>
        </form>
    </div>
    ';

    // Obsługa przycisku Anuluj
    if(isset($_POST['cancel_add'])) {
        RefreshPage();

    // Obsługa przycisku Dodaj
    } else if(isset($_POST['confirm_add'])) {
        // Zamiana na poprawną wartość status, tj. w EdytujPodstrone()
        if(isset($_POST['new_page_status']))
            $status = 1;
        else
            $status = 0;
        
        // Ochrona przed SQL injection, tj. w EdytujPodstrone()
        $title = mysqli_real_escape_string($link, $_POST['add_page']);
        $content = mysqli_real_escape_string($link, $_POST['new_page_content']);

        // Zapytanie dodania strony do bazy
        $query = 'INSERT INTO page_list VALUES (NULL,"'.$title.'","'.$content.'","'.$status.'")';

        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $query)) {
            echo '<script>alert("Dodano stronę");</script>';
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }
    return $return;
}

// Strona główna
// Zawiera formularz logowania i wszystkie funkcje użytkownika zalogowanego
function ControlPanel() {
    // Potrzebna zmienna $link do zapytań
    include('cfg.php');

    // Wiadomość o nieudanym logowaniu
    $login_failed_msg = '<br> <h3 class="errormsg">Niepoprawne dane logowania</h3>';
    
    // Przycisk "Wyloguj"
    $logout_btn = ' 
    <form method="POST" name="logout-form" enctype="multipart/form-data" action="'.$_REQUEST['URI'].'">
    <input class="btn evilbtn" type="submit" name="logout" value="Wyloguj">
    </form>
    ';

    // Wynik funkcji, wszystko co ma trafić do returna
    // Wartość wpisana tutaj jest wyświetlana jako placeholder gdy nie ma nic innego
    // np. po wylogowaniu ale przed odświeżeniem strony
    $return = 'ładowanie...<br>(jeśli trwa dłużej niż sekundę to coś jest nie tak)';

    // Pokaż formularz kontakt
    if(isset($_GET['contact_form'])) {
        return PokazKontakt();
    }

    // Wszystkie funkcje dostępne dla użytkownika zalogowanego
    // Domyślnie wyświetla listę podstron
    if($_SESSION['logged_in'] === true || ($_POST['login'] === $login && $_POST['password'] === $password)) {

        // Reset zmiennej nieudanego logowania
        $_SESSION['login_failed'] = false;

        // Zapisanie stanu logowania (tzn zalogowano) dla sesji
        $_SESSION['logged_in'] = true;

        // Obsługa przycisku "Wyloguj"
        if(isset($_POST['logout'])) {
            $_SESSION['logged_in'] = false;
            RefreshPage();

        // Obsługa przycisku "Edytuj"
        } else if(isset($_POST['edit_page'])) {
            $return = EdytujPodstrone();
        
        // Obsługa przycisku "Usuń"
        } else if(isset($_POST['delete_page'])) {
            $return = UsunPodstrone();
        
        // Obsługa przycisku "Dodaj stronę"
        } else if(isset($_POST['add_page'])) {
            $return = DodajNowaPodstrone();

        // Strona wyświetlana domyślnie
        } else {
            $return = ListaPodstron();
        }

        // Przycisk wyloguj na każdej stronie jeśli zalogowano
        $return = $return.$logout_btn;
    } else {
        if($_SESSION['login_failed'] === false) {
            // Pierwsze wyświetlenie formularza
            // bez wiadomości o nieudanym logowaniu
            $_SESSION['login_failed'] = true;

            $return = FormularzLogowania();
        } else {
            if($_POST['login'] == '' && $_POST['password'] == '')
                $return = FormularzLogowania();
            else
                // Jeśli zostały wprowadzone dane, ale nie powiodło się logowanie
                // jest wyświetlana wiadomość o nieudanym logowaniu
                $return = FormularzLogowania().$login_failed_msg;
        }
    }
    return $return;
}

?>
