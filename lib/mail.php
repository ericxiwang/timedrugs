<?php


include("class.phpmailer.php");
  
include("class.smtp.php");



$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "ssl://smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "gowest.wang@gmail.com";
$mail->Password = "p@ssw)rd";


$mail->SetFrom("gowest.wang@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("gowest.wang@gmail.com");
 if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }
  


?>