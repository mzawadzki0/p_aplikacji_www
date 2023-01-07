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

}

function UsunProdukt() {
    
}

function EdytujProdukt() {
    
}

function ListaProduktow() {
    
}

?>
