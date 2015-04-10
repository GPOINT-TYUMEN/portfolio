<?php
/**
* Created by PhpStorm.
* User: ZMac
* Date: 3/5/14
* Time: 2:10 AM
*/

class SendEmailFromForm
{
    public $labelMap = array();

    public function buildHtml()
    {
        $text = '';
        foreach ($this->labelMap as $name => $label) {
            $text .= "<b>$label:</b> " . $_POST[$name] . '<br/>';
        }
return $text;
    }
    public function sendEmail($toEmail, $fromEmail, $fromName, $message, $subject)
    {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";

        // Additional headers
        //$headers .= "To: $toName <$toEmail>\r\n" ;
        $headers .= "From: $fromName <$fromEmail>\r\n" ;
        $headers .= "Reply-To: $fromEmail\r\n" ;
        $headers .= "X-Mailer: PHP/" . phpversion(); ;
        //$headers .= "Cc: new1@mail.ru" . "\r\n";
    // $headers .= "Bcc: birthdaycheck@example.com" . "\r\n";
        $to = $toEmail;
        mail($to, $subject, $message, $headers);
    }
} 