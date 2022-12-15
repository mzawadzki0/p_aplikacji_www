<?php

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

function WyslijMailKontakt() {
    // zmienna $email z adresem email odbiorcy
    include('mail.php');

    // sprawdzenie czy wypełniono wszystkie pola formularza
    if(empty($_POST['contact_email']) || empty($_POST['contact_subject']) || empty($_POST['contact_message'])) {
        echo '<h4 class="errormsg">Formularz zawiera puste pola!</h4>';
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

function PrzypomnijHaslo() {

}

if(isset($_POST['contact_send'])) {
    WyslijMailKontakt();
}

?>
