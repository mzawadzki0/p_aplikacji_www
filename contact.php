<?php

// Funkcja wyświetla formularz kontakotwy na stronie (host)/(index)/?contact_form
function PokazKontakt() {
$return = '
<div class="container vertical">
        <form method="POST" name="contact_form" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
        <fieldset>
            <div class="container vertical form form-item">
                <div>
                    <label for="contact-email-field">Adres email: </label>
                    <input name="contact_email" type="email" id="contact-email-field">
                </div>
                <div>
                    <label for="contact-subject-field">Temat: </label>
                    <input name="contact_subject" type="text" id="contact-subject-field">
                </div>
                <div style="width: 100%" class="container vertical">
                    <label for="contact-msg-field">Treść wiadomości:<br></label>
                    <textarea name="contact_message" rows="15" id="contact-msg-field"></textarea>
                </div>
                <input class="btn neutralbtn form-item" type="submit" name="contact_send" value="Wyślij">
            </div>
        </fieldset>
        </form>
    </div>
';

return $return;
}

// Funkcja dopowiedzialna za wysłanie maila z danymi z formularza kontaktowego, na adres z mail.php
function WyslijMailKontakt() {
    // zmienna $email
    include('mail.php');

    // sprawdzenie czy wypełniono wszystkie pola formularza
    if(empty($_POST['contact_email']) || empty($_POST['contact_subject']) || empty($_POST['contact_message'])) {
        echo '<script>alert("Formularz zawiera puste pola!");</script>';
        return PokazKontakt();
    }

    // Header props
    $header = 'MIME-Version: 1.0\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: binary;'."\r\n";
    $header .= 'X-Sender: <'.$_POST['contact_email'].'>'."\r\n";
    $header .= 'X-Mailer: PRapWWW mail 1.2\r\n';
    $header .= 'X-Priority: 3\r\n';
    $header .= 'Return-Path: <'.$_POST['contact_email'].'>'."\r\n";
    $header .= 'From: '.$_POST['contact_email']."\r\n";  

    // wysłanie emaila lub wyświetlenie komunikatu błędu
    if(mail($email, $_POST['contact_subject'], $_POST['contact_message'], $header)) {
        echo '<script>alert("Email wysłany pomyślnie");</script>';
    } else {
        echo '<script>alert("Błąd podczas wysyłania");</script>';
    }
}

// Funkcja wysyłająca email na adres z ./mail.php z przypomnieniem hasła
// dostępna z przycisku na stronie logowania jeśli nie zalogowano
function PrzypomnijHaslo() {
    // Przycisk Przypomnij hasło
    $button = '<div class="container vertical form"><form method="POST">
        <button type="submit" name="remind_password">Przypomnij hasło</button>
        </form></div>';

    if(isset($_POST['remind_password'])) {
        // $email
        include('mail.php');

        // $password
        include('cfg.php');

        // Header props
        $header = 'MIME-Version: 1.0\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: binary;'."\r\n";
        $header .= 'X-Sender: <noreply@localhost>'."\r\n";
        $header .= 'X-Mailer: PRapWWW mail 1.2\r\n';
        $header .= 'X-Priority: 3\r\n';
        $header .= 'Return-Path: <'.'>'."\r\n";
        $header .= 'From: noreply@localhost'."\r\n";

        // Temat i treść emaila
        $subject = 'Przypomnienie hasła administratora serwera';
        $message = 'Aktualne hasło: ['.$password.']';

         // wysłanie emaila i wyświetlenie informacji lub komunikatu błędu
        if(mail($email, $subject, $message, $header)) {
            $return = '<div class="container vertical form"><h4>Wysłano email z przypomnieniem hasła!</h4></div>';
        } else {
            $return = '<div class="container vertical form"><h4 class="errormsg">Błąd podczas wysyłania przypomnienia</h4></div>';
        }
        
        return $button.$return;
        
    } else {
        return $button;
    }
    
}

// Obsługa przycisku "wyślij" w formularzu kontaktowym
if(isset($_POST['contact_send'])) {
    WyslijMailKontakt();
}

?>
