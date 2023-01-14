<?php


// Funkcja główna zwracająca komponent na podstawie zmiennych POST
function Categories() {
    if(isset($_POST['add_category'])) {
        return DodajKategorie();

    } else if(isset($_POST['edit_category'])) {
        return EdytujKategorie();

    } else if(isset($_POST['delete_category'])) {
        return UsunKategorie();

    // Wyświetlane domyślnie
    } else {
        return ListaKategorii();
    }
}

// Funkcja odpowiadająca za formularz dodania kategorii
function DodajKategorie() {
    // Zmienna $link potrzebna do zapytania
    include('cfg.php');

    $return = '
    <div class="container vertical">
        <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <fieldset>
            <div class="container vertical form form-item">
                <div>
                    <label for="categoryname">Nazwa kategorii</label>
                    <input type="text" id="categoryname" placeholder="nie może być puste" minlength="1" maxlength="30" name="add_category">
                </div>
                <div>
                    <label for="categoryparent">Kategoria nadrzędna</label>
                    <select id="categoryparent" name="new_parent">
                        <option value="NULL">(brak)</option>
                        '.CategoryDropdown().'
                    </select>
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
        
        // Ochrona przed SQL injection
        $name = mysqli_real_escape_string($link, $_POST['add_category']);
        $parent = $_POST['new_parent'];

        // Zapytanie dodania kategorii
        $query = 'INSERT INTO category_list VALUES (NULL,'.$parent.',"'.$name.'")';

        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $query)) {
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }
    return $return;

}

function UsunKategorie() {
    include('cfg.php');

    // Zapytanie wybierające dane kategorii o właściwym id
    $query = 'SELECT * FROM category_list_parents_named WHERE id='.$_POST['delete_category'].' LIMIT 1';


    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    $parent = $row['parent_id'];

    $name = htmlentities($row['category_name']);
    $parent_name = htmlentities($row['parent_category_name']);

    // Treść do wyświetlenia
    // id, nazwa, id i nazwa rodzica i przyciski Usuń, Anuluj
    $return = '
        <div class="container vertical form">
        <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <fieldset>
        <div class="container vertical form form-item">
            <div class="errormsg">
                Nastąpi usunięcie kategorii:
            </div>
            <div>
                <label for="categoryid">ID</label>
                <input id="categoryid" name="delete_category" "type="text" readonly="readonly" value='.$_POST['delete_category'].'><br>
                <label for="categoryname">Nazwa kategorii</label>
                <input id="categoryname" type="text" readonly="readonly" value="'.$name.'"><br>
                <label for="categoryparent">Kategoria nadrzędna</label>
                <input id="categoryparent" type="text" readonly="readonly" value="'.$parent_name.' ('.$parent.')">
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
        // Zapytanie usuwające kategorię
        $new_query = 'DELETE FROM category_list WHERE id='.$id.' LIMIT 1';
        
        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $new_query)) {
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }
    return $return;
}

function EdytujKategorie() {
    include('cfg.php');

    // Zapytanie wybierające wszystkie pola rekordu do formularza
    $query = 'SELECT * FROM category_list WHERE id='.$_POST['edit_category'].' LIMIT 1';
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    // Zapobiega interpretowaniu tagów HTML z wybieranej treści
    $name = htmlentities($row['category_name']);

    $id = $row['id'];
    $parent = $row['parent_id'];

    // formularz edycji kategorii
    $return = '
    <div class="container vertical form form-item">
        <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <fieldset>
            <div class="container vertical form form-item">
                <div>
                    '.CategoryTree($id).'
                </div>
                <div>
                    <label for="categoryid">id</label>
                    <input id="categoryid" name="edit_category" "type="number" readonly="readonly" value='.$id.'>
                </div>
                <div>
                    <label for="categoryname">Nazwa kategorii</label>
                    <input type="text" id="categoryname" placeholder="nie może być puste" minlength="1" maxlength="30" name="current_name" value="'.$name.'">
                </div>
                <div>
                    <label for="categoryparent">Kategoria nadrzędna</label>
                    <select id="categoryparent" name="current_parent">
                        <option value="NULL">(brak)</option>
                        '.CategoryDropdown($parent).'
                    </select>
                </div>
                <div>
                    <input class="btn neutralbtn" style="margin-top: 10px" type="submit" name="cancel_save" value="Anuluj">
                    <input class="btn goodbtn" style="margin-top: 10px" type="submit" name="confirm_save" value="Zapisz">
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
    } else if(isset($_POST['confirm_save'])) {
        
        // Ochrona przed SQL injection
        $new_name = mysqli_real_escape_string($link, $_POST['current_name']);
        $new_parent = $_POST['current_parent'];

        // Zapytanie aktualizujące nazwę i rodzica kategorii
        $new_query = 'UPDATE category_list SET category_name="'.$new_name.'", parent_id='.$new_parent.' WHERE id='.$_POST['edit_category'].' LIMIT 1';
        
        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $new_query)) {
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }
    return $return;
}

function ListaKategorii() {
    include('cfg.php');

    // Przycisk dodaj kategorię
    $add_category = '
    <input class="btn goodbtn" id="addcategory" type="submit" name="add_category" value="Dodaj kategorię">
    ';

    // Zapytanie
    $query = 'SELECT * FROM category_list_parents_named ORDER BY id ASC LIMIT 500';
    $result = mysqli_query($link, $query);


    // Treść zwracana przez funkcję, tabela kategorii z przuciskami usuń i edytuj
    $return = '<div class="container vertical form form-item"><form method="POST" enctype="multipart/form-data"><fieldset>
    <div class="container vertical form form-item">
        '.$add_category.'
    </div>
    <table class="item-list" id="category_list">
        <tr>
            <th>
                ID
            </th><th style="min-width: fit-content">
                Nazwa
            </th><th>
                (ID) Kategoria nadrzędna
            </th>
        </tr>';
    while($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $parent = $row['parent_id'];
        $name = $row['category_name'];
        $parent_name = $row['parent_category_name'];
        // Przycisk edytuj rekord
        $edit_button = '<button type="submit" name="edit_category" value='.$id.'>edytuj</button>';

        // Przycisk usuń rekord
        $delete_button = '<button type="submit" name="delete_category" value='.$id.'>usuń</button>';
        $return = $return.'<tr><td>'.$id.'</td><td>'.$name.'</td><td>('.$parent.') '.$parent_name.'</td><td>'.$edit_button.'</td><td>'.$delete_button.'</td></tr>';
    }
    $return = $return.'</fieldset></table></form></div>';
    return $return;
}

// Funkcja pomocnicza do wyświetlenia elementu <options> bez <select> z listą nazw i id kategorii
// selected_id to id opcji wybranej domyślnie
// order_by to pole do sortowania
function CategoryDropdown($selected_id, $order_by='id') {
    include('cfg.php');

    $query = 'SELECT id, category_name FROM category_list ORDER BY '.$order_by.' ASC LIMIT 500';
    $result = mysqli_query($link, $query);

    $return = '';

    // rekordy jako elementy <option>, selected przy $selected_id
    while($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['category_name'];
        
        $return .= '<option value="'.$id.'" ';

        if($selected_id === $id)
            $return .= 'selected';

        $return .= '>'.$name.' ('.$id.')</option>';
    }

    return $return;
}

// Proste drzewo kategorii dla pojedynczego id
function CategoryTree($id) {
    include('cfg.php');

    $query = 'SELECT category_name,parent_id FROM category_list WHERE id='.$id.' LIMIT 1';
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    // Zapobiega interpretowaniu tagów HTML z wybieranej treści
    $name = htmlentities($row['category_name']);
    $parent = $row['parent_id'];

    // Rekurencja
    if($parent != '') {
        return CategoryTree($parent).'> '.$name;
    }

    // Kategoria z pustym rodzicem będzie zapisana jako:
    return '*> '.$name;
}

?>
