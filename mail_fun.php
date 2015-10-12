<?php

require_once "Mail.php";

$from = '<gowest.wang@gmail.com>';
$to = '<gowest.wang@gmail.com>';
$subject = 'Hi!';
$body = "Hi,\n\nHow are you?";

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'gowest.wang@gmail.com',
        'password' => 'p@ssw)rd'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
} else {
    echo('<p>Message successfully sent!</p>');
}


?>