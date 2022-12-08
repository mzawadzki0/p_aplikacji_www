<?php
    function pokazPodstrone($id, $link) {
        // Zwracane w przypadku kiedy strona nieaktywna (status==0)
        $status_zero_msg = '<div class="errormsg">Strona nieaktywna!</div>';

        // pass jeśli id jest liczbą całkowitą nieujemną
        if(!is_numeric($id) || !is_int($id + 0) || $id < 0) {
            return '<h3>[nie znaleziono strony]</h3>';
        }

        // ochrona przed SQL injection
        $id_clear = htmlspecialchars($id);
        
        $query = 'SELECT * FROM page_list WHERE id='.$id_clear.' LIMIT 1';
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);

        if($row['status'] == 0)
            return $status_zero_msg;

        if(empty($row['id'])) {
            $web = '<h3>[nie znaleziono strony]</h3>';
        } else {
            $web = $row['page_content'];
        }

        return $web;
    }
?>
