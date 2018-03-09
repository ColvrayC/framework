<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'PHPMailer/extras/Security.php';


$security = new Security();

// This IF condition is for improving security and Prevent Direct Access to the Mail Script.
if (isset($_POST['name']) AND isset($_POST['email']) AND isset($_POST['message']))
{    
    // Collect POST data from form
    $name = $security->xss_clean($_POST['name']);
    $email = $security->xss_clean($_POST['email']);
    $message = $security->xss_clean($_POST['message']);
    
    // Prefedined Variables  


    // Collecting all content in HTML Table
    $content = '<table width="100%">
    <tr><td colspan="2"><strong>Le client a pris contact avec vous:</strong></td></tr>
    <tr><td valign="top">Nom du client :</td><td>' . $name . '</td></tr>
    <tr><td valign="top">Email de contact:</td><td>' . $email . '</td></tr><br/>
    <tr><td valign="top">Message:</td><td>' . $message . '</td></tr>
    </table> ';

    //PHPMailer Object
    $mail = new PHPMailer;

//From email address and name
    $mail->From = "adress@mail.fr";
    $mail->FromName = "Nouveau mail";

//To address and name
    $mail->addAddress("adresse@mail.fr"); //sarl.viti-plants@orange.fr

//Address to which recipient will reply
    $mail->addReplyTo("adress@mail.fr");


//Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "Un message a ete envoye depuis le site web xxxxxxxx";
    $mail->Body = $content;
    // Send the message
    $send = false;
    if ($mail->send()) 
    {
        $send = true;
    }

    echo json_encode($send);
}