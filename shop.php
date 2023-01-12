<?php

// Odświerz stronę aby załadować nową zawartość koszyka
// Należałoby zaimplementować odświerzanie pojedynczego elementu w jQuery

use FFI\Exception;

function softRefresh() {
    echo "<meta http-equiv='refresh' content='0'>";
}

// Główna funkcja rysująca stronę sklepu,
// formularz dodawania i usuwania produktów z koszyka
function Sklep() {
    $return = '
    <div class="container horizontal" id="grid-root">
        <div class="container horizontal" id="product-tab">
            '.Produkty().'
        </div>
        <div class="container vertical" id="cart-tab">
            <h3><u>Koszyk</u></h3>
            '.Koszyk().'
        </div>
    </div>
    ';

    // Obsługa przycisku Dodaj do koszyka
    if(isset($_POST['add-to-cart'])) {
        addToCart($_POST['add-to-cart'], $_POST['count']);
    } else if(isset($_POST['remove-from-cart'])) {
        removeFromCart($_POST['remove-from-cart']);
    }

    return $return;
}

// Funkcja formatująca i pokazująca wszystkie dostępne produkty wraz z przyciskami "Dodaj do koszyka"
function Produkty() {
    // Zmienna $link do bazy
    include('cfg.php');

    // Zapytanie wybierające tylko dostępne produkty z katalogu
    $query = 'SELECT id,name,net_price,vat_percent,units_in_stock,photo 
    FROM product_list 
    WHERE (date_expires IS NULL OR date_expires > NOW()) AND units_in_stock > 0 AND availablity = 1 
    ORDER BY date_expires DESC, date_created ASC 
    LIMIT 200';

    $result = mysqli_query($link, $query);
    
    $return = '';

    while($row = mysqli_fetch_array($result)) {

        $id = $row['id'];
        $name = $row['name'];
        $photo = $row['photo'];
        $vat = $row['vat_percent'];
        $count = $row['units_in_stock'];

        // Ładne formatowanie ceny
        $price = number_format($row['net_price'] * (100+$vat) / 100 , 2, ',', ' ');
        
        $return .= '
        <div class="container vertical product-listing">
            <div class="container vertical product-listing-img">
                <img src="img/products/'.$photo.'">
            </div>
            <div class="product-listing-name">'.$name.'</div>
            <div class="product-listing-price">'.$price.' zł</div>
            <form class="container vertical" method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'" >
                <div class="cart-selected-count">
                    <input class="cart-selected-count-input" type="number" min="1" max="'.$count.'" id="selected-count" name="count" value="1">
                    <label for="selected-count">/'.$count.' szt.</label>
                </div>
                <button type="submit" class="btn neutralbtn" name="add-to-cart" value="'.$id.'">Dodaj do koszyka</button>
            </form>
        </div>
        <div class="separator"></div>
        ';
    }
    return $return;
}

function Koszyk() {
    include('cfg.php');

    // Alias
    $cart = &$_SESSION['cart'];

    if(!isset($cart)) {
        $cart = array();
    }

    // Domyślna zawartość koszyka
    $return = 'Koszyk jest pusty';

    if(!empty($cart)) {
        $return = '';
        foreach($cart as $id => $selected_count) {
            $query = 'SELECT name,net_price,vat_percent,units_in_stock
            FROM product_list 
            WHERE id='.$id.' 
            LIMIT 1';

            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);

            $name = $row['name'];
            $vat = $row['vat_percent'];
            $count = $row['units_in_stock'];

            // Ładne formatowanie ceny
            $price = number_format($selected_count * $row['net_price'] * (100+$vat) / 100 , 2, ',', ' ');

            $return .= '
            <div class="container vertical cart-item">
                <div>
                    '.$name.'
                </div>
                <div>
                    ilość: '.$selected_count.'/'.$count.'
                </div>
                <div>
                    '.$price.' zł
                </div>
                <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'" >
                    <button type="submit" class="btn evilbtn" name="remove-from-cart" value="'.$id.'">Usuń z koszyka</button>
                </form>
            </div>
            ';
        }
    }
    
    return $return;
}

function addToCart($id, $count) {
    // Alias
    $cart = &$_SESSION['cart'];
    
    // Dodaj 1 szt. produktu
    // id jest kluczem w tablicy
    if(!array_key_exists($id, $cart)) {
        $cart[$id] = $count;
        softRefresh();
    }
}

function removeFromCart($id) {
    // Alias
    $cart = &$_SESSION['cart'];
    
    // Dodaj 1 szt. produktu
    // id jest kluczem w tablicy
    if(array_key_exists($id, $cart)) {
        unset($cart[$id]);
        softRefresh();
    }
}

?>