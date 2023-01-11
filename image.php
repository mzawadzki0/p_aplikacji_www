<?php

// Plik do wstawienia jako żródło obrazu (produktu)
// z wartością GET ?product=id
// Zwraca zawartość pól BLOB jako prawidłowy jpeg

// Sprawdzenie poprawności id
include('validateId.php');

if(isset($_GET['product']) && isCorrectId($_GET['product'])) {
    include('cfg.php');

    // Zapytanie wybierające obraz
    $query = 'SELECT photo FROM product_list WHERE id='.$_GET['product'].' LIMIT 1';
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    // 404 jeśli nie ma obrazu lub nie ma id w bazie
    if(empty($row)) 
        header("HTTP/1.0 404 Not Found", true, 404);
    else {
        header('Content-type: image/jpeg');
        echo $row['photo'];
    }
} else {
    header("HTTP/1.0 400 Bad Request", true, 400);
}

?>
