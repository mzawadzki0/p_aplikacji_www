<?php

function Products() {
    if(isset($_POST['add_product'])) {
        return DodajProdukt();

    } else if(isset($_POST['edit_product'])) {
        return EdytujProdukt();

    } else if(isset($_POST['delete_product'])) {
        return UsunProdukt();

    // Wyświetlane domyślnie
    } else {
        return ListaProduktow();
    }
}

function DodajProdukt() {
    include('cfg.php');

    // funkcja CategoryDropdown()
    include('product_categories.php');

    // Data potrzebna do minimum wartości pola expires,
    // następnie jako wartość date_created i date_modified
    $date_now = date("Y-m-d H:i:s");

    // Formularz dodawania nowego produktu
    // Prosta walidacja wejścia za pomocą <input type, minlength, maxlength, min, max, step, accept
    $return = '
    <div class="container vertical form-item">
    <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
    <fieldset>
        <div class="container vertical form form-item">
            <label for="productname">Nazwa produktu</label>
            <input class="wide" type="text" id="productname" placeholder="nie może być puste" minlength="1" maxlength="80" name="add_product">
            Opis produktu
            <textarea class="wide" placeholder="nie może być puste" minlength="1" name="new_description" rows=10 ></textarea><br>
            Gabaryty
            <textarea class="wide" maxlength="200" name="new_size" rows=5 ></textarea><br>
            <div class="container horizontal">
                <div class="container vertical">
                    <div>   
                        <label for="productexpires">Data wygaśnięcia</label>
                        <input type="datetime-local" id="productexpires" name="new_expires" min="'.$date_now.'" step="1">
                    </div>
                    <div>
                        <label for="nproductnetprice">Cena netto</label>
                        <input type="number" inputmode="decimal" placeholder="nie może być puste" step="0.01" min="0" max="9999999999.99" id="productnetprice" name="new_price" >
                    </div>
                    <div>
                        <label for="productvat">VAT %</label>
                        <input type="number" inputmode="decimal" step="1" min="0" max="999" id="productvat" name="new_vat" value="0">
                    </div>
                    <div>
                        <label for="productcount">Ilość</label>
                        <input type="number" placeholder="nie może być puste" min="0" max="9999999999" id="productcount" name="new_count" >
                    </div>
                    <div>
                        <label for="productavailable">Produkt dostępny</label>
                        <input type="checkbox" id="productavailable" name="new_available" checked>
                    </div>
                    <div>
                        <label for="productcategory">Kategoria produktu</label>
                        <select id="productcategory" name="new_category">
                            <option value="NULL">(brak)</option>
                            '.CategoryDropdown(null, 'category_name').'
                        </select>
                    </div>
                </div>
                <div class="container vertical form">
                    Zdjęcie produktu 
                    <input type="file" accept="image/*" id="newproductphoto" name="new_photo">
                </div>
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

    // Obsługa przycisku "Anuluj"
    if(isset($_POST['cancel_add'])) {
        RefreshPage();

    // obsługa przycisku "Zapisz"
    } else if(isset($_POST['confirm_add'])) {
        
        // Ochrona przed SQL injection
        $name = mysqli_real_escape_string($link, $_POST['add_product']);
        $description = mysqli_real_escape_string($link, $_POST['new_description']);
        $size = mysqli_real_escape_string($link, $_POST['new_size']);

        $price = $_POST['new_price'];
        $vat = $_POST['new_vat'];
        $count = $_POST['new_count'];
        $category = $_POST['new_category'];

        // Data powinna być NULL jeśli nie wpisana, zamiast samych zer
        $expires = empty($_POST['new_expires']) ? 'NULL' : '"'.$_POST['new_expires'].'"';;


        // Checkbox na 1 lub 0
        if(isset($_POST['new_available']))
            $available = 1;
        else
            $available = 0;
        
        // Domyślnie lub w przypadku błędu wysłania pliku nie ustawiamy zdjęcia
        $photo = 'NULL';

        $file_data = $_FILES['new_photo'];
        $file = $file_data['name'];

        if(!empty($file)) {

            // Funkcja wysyłająca plik jeśli rozszerzenie pasuje
            if(uploadFile($file_data, 'img/products/', array('jpg', 'png', 'jpeg', 'webp', 'gif'))) {

                // Zapytanie z nazwą nowego pliku na serwerze
                $photo = '"'.$file.'"';
            } else {
                
                // Komunikat błędu
                echo '<script>alert("Błąd podczas wysyłania pliku");</script>';
                return $return;
            }
        }

        // Zapytanie aktualizujące produkt wg danych z formularza
        $query = 'INSERT INTO product_list VALUES (NULL, 
        "'.$name.'", 
        "'.$description.'", 
        "'.$date_now.'", 
        "'.$date_now.'", 
        '.$expires.', 
        "'.$price.'", 
        "'.$vat.'", 
        "'.$count.'", 
        "'.$available.'", 
        '.$category.', 
        "'.$size.'", 
        '.$photo.' )';
        
        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $query)) {
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }

    return $return;

}

function UsunProdukt() {
    include('cfg.php');

    // Zapytanie wybierające pola rekordu do formularza
    $query = 'SELECT id,name,date_created,category,units_in_stock,availablity,(SELECT category_name FROM category_list WHERE id=category LIMIT 1) as category_name FROM product_list WHERE id='.$_POST['delete_product'].' LIMIT 1';
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    // Zapobiega interpretowaniu tagów HTML z wybieranej treści
    $name = htmlentities($row['name']);
    
    $id = $row['id'];
    $count = $row['units_in_stock'];
    $category_name = $row['category_name'];
    $created = $row['date_created'];

    // Formularz z polami readonly
    $return = '
    <div class="container vertical form-item">
    <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
    <fieldset>
        <div class="container vertical form form-item">
            <div>
                <label for="productid">ID</label>
                <input id="productid" name="delete_product" "type="number" readonly="readonly" value='.$id.'>
            </div>
            <label for="productname">Nazwa produktu</label>
            <input class="wide" type="text" id="productname" readonly="readonly" value="'.$name.'">
            <div>
                <label for="created">Utworzono</label>
                <input type="datetime-local" readonly="readonly" id="created" value="'.$created.'">
            </div>
            <div>
                <label for="productcount">Ilość</label>
                <input type="text" readonly="readonly" id="productcount" value="'.$count.'">
            </div>
            <div>
                <label for="productcategory">Kategoria produktu</label>
                <input id="productcategory" readonly="readonly" value='.$category_name.'>
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

    // "Anuluj"
    if(isset($_POST['cancel_delete'])) {
        RefreshPage();

    // obsługa przycisku "Usuń"
    } else if(isset($_POST['confirm_delete'])) {
        $new_query = 'DELETE FROM product_list WHERE id='.$id.' LIMIT 1';

        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $new_query)) {
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }

    return $return;
}

function EdytujProdukt() {
    include('cfg.php');

    // funkcja CategoryDropdown()
    include('product_categories.php');

    // Zapytanie wybierające pola rekordu do formularza
    $query = 'SELECT id,name,description,date_created,date_expires,net_price,vat_percent,units_in_stock,availablity,category,size,photo FROM product_list WHERE id='.$_POST['edit_product'].' LIMIT 1';
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    // Nie do edycji, ale jest limitem do ustawienia daty wygaśnięcia
    $created = $row['date_created'];

    // Zapobiega interpretowaniu tagów HTML z wybieranej treści
    $name = htmlentities($row['name']);
    $description = htmlentities($row['description']);
    
    $id = $row['id'];
    $expires = $row['date_expires'];
    $price = $row['net_price'];
    $vat = $row['vat_percent'];
    $count = $row['units_in_stock'];
    $available = $row['availablity'];
    $category = $row['category'];
    $size = $row['size'];
    $photo = $row['photo'];

    if($photo) {
        $photo_html = '<img id="currentproductphoto" alt="(tu powinno być zdjęcie produktu)" src="img/products/'.$photo.'" />';
    } else {
        $photo_html = '<div class="errormsg">(brak zdjęcia)</div>';
    }

    // Checkbox checked jeśli $available=1
    if($available == 1)
        $available = 'checked';
    else
        $available = '';

    // Wysokość początkowa pól textarea na podstawie liczby newline w polach rekordu
    // ale nie mniej niż X
    $height_description = substr_count($description, "\n");
    $height_description = $height_description < 10 ? 10 : $height_description + 1;
    $height_size = substr_count($size, "\n");
    $height_size = $height_size < 5 ? 5 : $height_size + 1;

    // Formularz edycji produktu
    // Prosta walidacja wejścia za pomocą <input type, minlength, maxlength, min, max, step, accept
    $return = '
    <div class="container vertical form-item">
    <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
    <fieldset>
        <div class="container vertical form form-item">
            <div>
                <label for="productid">ID</label>
                <input id="productid" name="edit_product" "type="number" readonly="readonly" value='.$id.'>
            </div>
            <label for="productname">Nazwa produktu</label>
            <input class="wide" type="text" id="productname" placeholder="pole nie może być puste" minlength="1" maxlength="80" name="current_name" value="'.$name.'">
            Opis produktu
            <textarea class="wide" placeholder="pole nie może być puste" name="current_description" rows="'.$height_description.'" >'.$description.'</textarea><br>
            Gabaryty
            <textarea class="wide" maxlength="200" name="current_size" rows="'.$height_size.'" >'.$size.'</textarea><br>
            <div class="container horizontal">
                <div class="container vertical">
                    <div>
                        <label for="productexpires">Data wygaśnięcia</label>
                        <input type="datetime-local" id="productexpires" name="current_expires" min="'.$created.'" step="1" value="'.$expires.'">
                    </div>
                    <div>
                        <label for="productnetprice">Cena netto</label>
                        <input type="number" inputmode="decimal" placeholder="nie może być puste" step="0.01" min="0" max="9999999999.99" id="productnetprice" name="current_price" value="'.$price.'">
                    </div>
                    <div>
                        <label for="productvat">VAT %</label>
                        <input type="number" inputmode="decimal" step="1" min="0" max="999" id="productvat" name="current_vat" value="'.$vat.'">
                    </div>
                    <div>
                        <label for="productcount">Ilość</label>
                        <input type="number" placeholder="nie może być puste" min="0" max="9999999999" id="productcount" name="current_count" value="'.$count.'">
                    </div>
                    <div>
                        <label for="productavailable">Produkt dostępny</label>
                        <input type="checkbox" id="productavailable" name="current_available" '.$available.'>
                    </div>
                    <div>
                        <label for="productcategory">Kategoria produktu</label>
                        <select id="productcategory" name="current_category">
                            <option value="NULL">(brak)</option>
                            '.CategoryDropdown($category, 'category_name').'
                        </select>
                    </div>
                </div>
                <div class="container vertical form">
                    Zdjęcie produktu 
                    <input type="file" accept="image/*" id="newproductphoto" name="new_photo">
                    <div>
                        <label for="replaceexistingphoto">Zastąp istniejące</label>
                        <input type="checkbox" id="replaceexistingphoto" name="replaceexistingphoto">
                    </div>
                    '.$photo_html.'
                </div>
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
        $new_description = mysqli_real_escape_string($link, $_POST['current_description']);
        $new_size = mysqli_real_escape_string($link, $_POST['current_size']);

        $new_price = $_POST['current_price'];
        $new_vat = $_POST['current_vat'];
        $new_count = $_POST['current_count'];
        $new_category = $_POST['current_category'];

        // Data powinna być NULL jeśli nie wpisana, zamiast samych zer
        $new_expires = empty($_POST['current_expires']) ? 'NULL' : '"'.$_POST['current_expires'].'"';

        // Data modyfikacji to sformatowana aktualna data i czas
        $new_modified = date("Y-m-d H:i:s");

        // Checkbox na 1 lub 0
        if(isset($_POST['current_available']))
            $new_available = 1;
        else
            $new_available = 0;
        
        // Domyślnie nic nie rób ze zdjęciem, 
        // Zastąp NULL jeśli zaznaczono checkbox ale nie podano żadnego pliku
        // Nic nie rób jeśli błąd z podanym plikiem
        $photo_query = '';
        if(isset($_POST['replaceexistingphoto']) || !$photo) {

            $file_data = $_FILES['new_photo'];
            $file = $file_data['name'];

            if(empty($file)) {

                // Reset do NULL
                $photo_query = ', photo=NULL';
            } else {
                // Funkcja wysyłająca pliki o danych formatach
                if(uploadFile($file_data, 'img/products/', array('jpg', 'png', 'jpeg', 'webp', 'gif'))) {
                    
                    // Wartość pola to nazwa pliku
                    $photo_query = ', photo="'.$file.'"';
                } else {

                    // Komunikat błędu
                    echo '<script>alert("Błąd podczas wysyłania pliku");</script>';
                    return $return;
                }
            }
        }
        echo '<script>alert("Błąd podczas wysyłania pliku");</script>';
        // Zapytanie aktualizujące produkt wg danych z formularza
        $new_query = 'UPDATE product_list SET name="'.$new_name.'", 
        description="'.$new_description.'", 
        size="'.$new_size.'", 
        date_modified="'.$new_modified.'", 
        date_expires='.$new_expires.', 
        net_price="'.$new_price.'", 
        vat_percent="'.$new_vat.'", 
        units_in_stock="'.$new_count.'", 
        availablity="'.$new_available.'", 
        category='.$new_category.'
        '.$photo_query.' 
        WHERE id='.$_POST['edit_product'].' LIMIT 1';
        
        // Wyświetl odpowiedni alert po wykonaniu zapytania
        if(mysqli_query($link, $new_query)) {
            RefreshPage();
        } else {
            echo '<script>alert("Błąd");</script>';
        }
    }
    return $return;
}

// Funkcja rysująca tabelę z listą produktów id, nazwa, data utworzenia itd.
// oraz przyciski Dodaj, Edytuj, Usuń
function ListaProduktow() {
    include('cfg.php');

    // Przycisk dodaj produkt
    $add_category = '
    <input class="btn goodbtn" id="addproduct" type="submit" name="add_product" value="Dodaj produkt">
    ';

    // Zapytanie
    $query = 'SELECT id,name,date_created,date_modified,date_expires,net_price,vat_percent,units_in_stock,availablity FROM product_list ORDER BY id DESC LIMIT 500';
    $result = mysqli_query($link, $query);


    // Treść zwracana przez funkcję, tabela kategorii z przuciskami usuń i edytuj
    $return = '<div class="container vertical form form-item"><form method="POST" enctype="multipart/form-data"><fieldset>
    <div class="container vertical form form-item">
        '.$add_category.'
    </div>
    <table class="item-list" id="product_list">
        <tr>
            <th>
                ID
            </th><th>
                Nazwa
            </th><th style="width: 13ex">
                Utworzono
            </th><th style="width: 13ex">
                Zmieniono
            </th><th style="width: 13ex">
                Data wygaśnięcia
            </th><th>
                Cena netto zł
            </th><th>
                VAT %
            </th><th>
                Ilość
            </th><th>
                Dostępny
            </th>
        </tr>';
    while($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $name = htmlentities($row['name']);
        $created = $row['date_created'];
        $modified = $row['date_modified'];
        $expires = $row['date_expires'];
        $price = $row['net_price'];
        $vat = $row['vat_percent'];
        $count = $row['units_in_stock'];
        $availablity = $row['availablity'] > 0 ? 'Tak' : 'Nie' ;

        // Przycisk edytuj rekord z id
        $edit_button = '<button type="submit" name="edit_product" value='.$id.'>edytuj</button>';

        // Przycisk usuń rekord z id
        $delete_button = '<button type="submit" name="delete_product" value='.$id.'>usuń</button>';
        
        $return = $return.'<tr>
        <td>'.$id.'</td>
        <td>'.$name.'</td>
        <td>'.$created.'</td>
        <td>'.$modified.'</td>
        <td>'.$expires.'</td>
        <td>'.$price.'</td>
        <td>'.$vat.'</td>
        <td>'.$count.'</td>
        <td>'.$availablity.'</td>
        <td>'.$edit_button.'</td>
        <td>'.$delete_button.'</td>
        </tr>';
    }

    $return = $return.'</fieldset></table></form></div>';
    return $return;

}

// Funkcja odopwiedzialna za wysłanie zdjęcia na serwer, do folderu $dir
// Plik w formacie $allowed_extensions
// Zwraca True jeśli powodzenie
function uploadFile($file_data, string $dir, array $allowed_extensions=null) {
    if(!empty($file_data['name'])) {
        // nazwa pliku klienta, rozszerzenie, pełna ścieżka
        $file = basename($file_data['name']);
        $extension = strtolower(pathinfo($file,PATHINFO_EXTENSION));
        $fullpath = $dir.$file;
        
        // Sprawdzenie rozszerzenia && upload na serwer
        if(($allowed_extensions==null || in_array($extension, $allowed_extensions)) && move_uploaded_file($file_data['tmp_name'], $fullpath)) {
            return true;
        }
    } 
    return false;
}

?>
