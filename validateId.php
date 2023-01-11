<?php

// funkcja sprawdza poprawność id do GET
// true jeśli id poprawne (jest liczbą & jest liczbą całkowitą & nieujemną)
function isCorrectId($id) {
    if(is_numeric($id) && is_int($id + 0) && $id >= 0)
        return true;
    return false;
}

?>
