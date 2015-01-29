<?php

if(isset($_POST['verzend']))
{
    $naar = $_REQUEST['Email'];
    $to = 'sebastiaanslyper@gmail.com';
    $subject = 'testen leden';
    $message  = 'test';
    mail($to, $subject, $message);
};
?>