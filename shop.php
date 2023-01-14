<?php

// Odświerz stronę aby załadować nową zawartość koszyka
// oraz zapobiegać ponownemu wysłaniu $_POST po F5 po każdym <input type=submit
// Należałoby zaimplementować eventlistener dla zwykłych przycisków lub/i
// odświerzanie pojedynczego elementu w jQuery lub React
// Prościej "seamless" przewinąć do ostatniej pozycji po ponownym załadowaniu ale
// serwer nadal obciążony
function hardRefresh() {
    // echo "<meta http-equiv='refresh' content='0'>";
    header('Location: ', true, 303);
}

// Główna funkcja rysująca stronę sklepu,
// formularz dodawania i usuwania produktów z koszyka
function Shop() {
    $return = '
    <div class="container horizontal" id="grid-root">
        <div class="container horizontal" id="product-tab">
            '.Products().'
        </div>
        <div class="container vertical" id="cart-tab">
            <h3 class="h-centered"><u>Koszyk</u></h3>
            '.Cart().'
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
function Products() {
    // Zmienna $link do bazy
    include('cfg.php');

    // Alias
    $cart = &$_SESSION['cart'];

    // Zapytanie wybierające tylko dostępne produkty z katalogu, tzn.
    // data wygaśnięcia >= data teraz LUB nie ma daty wydaśnięcia
    // dostępność = dostępny
    // liczba w magazynie > 0
    // Sortuj: data wygaśnięcia od najbliższej do teraz, potem data dodania od najnowszych
    $query = 'SELECT id,name,net_price,vat_percent,units_in_stock,photo 
    FROM product_list 
    WHERE (date_expires IS NULL OR date_expires >= NOW()) AND units_in_stock > 0 AND availablity = 1 
    ORDER BY date_expires DESC, date_created DESC 
    LIMIT 200';

    $result = mysqli_query($link, $query);
    
    $return = '';

    while($row = mysqli_fetch_array($result)) {

        $id = $row['id'];
        $name = $row['name'];
        $photo = $row['photo'];
        $vat = $row['vat_percent'];
        $count = $row['units_in_stock'];

        // Liczba aktualnie w koszyku lub domyślnie 1
        // oraz dodaj styl CSS jeśli w koszyku
        if(isset($cart[$id])) {
            $selected_count = $cart[$id];
            $class_in_cart = ' product-selected-in-cart';
        } else {
            $selected_count = 1;
            $class_in_cart = '';
        }

        //Cena brutto
        $price = $row['net_price'] * (100+$vat) / 100;

        // Ładne formatowanie ceny
        $price = number_format($price , 2, ',', '&nbsp');
        
        $return .= '
        <div class="container vertical product-listing">
            <div class="container vertical product-listing-img">
                <img src="img/products/'.$photo.'">
            </div>
            <div class="product-listing-name">'.$name.'</div>
            <div class="product-listing-price">'.$price.' zł</div>
            <form class="container vertical" method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'" >
                <div class="product-selected-count">
                    <input class="product-selected-count-input'.$class_in_cart.'" type="number" min="1" max="'.$count.'" id="selected-count" name="count" value="'.$selected_count.'">
                    <label for="selected-count">/'.$count.' szt.</label>
                </div>
                <button type="submit" class="btn neutralbtn" name="add-to-cart" value="'.$id.'">Dodaj do koszyka</button>
            </form>
        </div>
        ';
    }
    return $return;
}

function Cart() {
    include('cfg.php');

    // Alias
    $cart = &$_SESSION['cart'];

    if(!isset($cart)) {
        $cart = array();
    }

    // Domyślna zawartość koszyka
    $return = '<div class="h-centered">Koszyk jest pusty</div>';

    if(!empty($cart)) {
        $return = '';

        // Suma cen zakupów
        $total = 0;

        // Iteruj po tablicy, formatuj i wypisz elementy koszyka
        // w kolejności ostatnio dodane na górze
        // Kolejność zepsuje się jeśli foreach() na tablicach działa inaczej w innych wersjach PHP
        // Tu do osiągnięcia celu wystarczy odwrócić kolejność kluczy z wartościami oraz usuwać przez unset()
        // Kolejność nie zmienia się po zmianie wartości klucza
        foreach(array_reverse($cart, true) as $id => $selected_count) {
            $query = 'SELECT name,net_price,vat_percent
            FROM product_list 
            WHERE id='.$id.' 
            LIMIT 1';

            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);

            $name = $row['name'];
            $vat = $row['vat_percent'];

            // Cena brutto
            $price = $selected_count * $row['net_price'] * (100+$vat) / 100;

            // Dodaj cenę do podsumowania
            $total += $price;

            // Ładne formatowanie ceny, wartość to ilość * cena jednostkowa
            $price = number_format($price , 2, ',', '&nbsp');

            $return .= '
            <div class="container vertical cart-item">
                <div>
                    <span class="cart-name">
                        '.$name.'
                    </span>
                    |
                    <span class="cart-count">
                        '.$selected_count.' szt.
                    </span>
                </div>
                <div class="cart-price">
                    <form method="POST" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'" >
                        <label for="cart-delete">'.$price.' zł</label>
                        <button id="cart-delete" type="submit" class="btn evilbtn" name="remove-from-cart" value="'.$id.'">Usuń</button>
                    </form>
                </div>
            </div>
            ';
        }

        // Ładne formatowanie sumy cen
        $total = number_format($total , 2, ',', '&nbsp');

        // Podsumowanie na górze koszyka
        $return = '
        <div class="container horizontal cart-item">
            <div>Suma:&nbsp</div><div class="cart-price">'.$total.' zł</div>
        </div>
        ' . $return;
    }
    
    return $return;
}

function addToCart($id, $count) {
    // Alias
    $cart = &$_SESSION['cart'];
    
    // Jeśli nie istnieje dodaj $count szt. produktu
    // id jest kluczem w tablicy
    if(!array_key_exists($id, $cart)) {
        
        $cart[$id] = $count;
    
    // Jeśli zmieniła się liczba szt. produktu
    } else if($cart[$id] != $count) {
        $cart[$id] = $count;
    }
    hardRefresh();
}

function removeFromCart($id) {
    // Alias
    $cart = &$_SESSION['cart'];
    
    // Dodaj 1 szt. produktu
    // id jest kluczem w tablicy
    if(array_key_exists($id, $cart)) {
        unset($cart[$id]);
    }
    hardRefresh();
}

?>