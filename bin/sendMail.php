<?php
    $to="arefyev.studio@gmail.com";
    $subject="Заказ с сайта (ru основной, контакт форма)";
    $body="Имя: ".trim(strip_tags($_REQUEST['name']))."\r\n";
    $body.="Email: ".trim(strip_tags($_REQUEST['email']))."\r\n";
    $body.="Услуга: ".trim(strip_tags($_REQUEST['service']))."\r\n";
    $body.="Сообщение: ".trim(strip_tags($_REQUEST['message']))."\r\n";
    $header .= "Content-type: text/plain; charset=\"utf-8\"";
    if (!mail($to,$subject,$body,$header))
        echo "Ошибка при отправке сообщения.";
    else
        echo "Сообщение отправлено.";