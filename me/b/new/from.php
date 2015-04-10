<?
error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once dirname(__FILE__) . '/SendEmailFromForm.php';

function sendEmailToUser($toEmail, $subject, $message) {
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf8' . "\r\n";

    // Additional headers
    $headers .= "From: <no-reply@booker-online.ru>\r\n" ;
    $headers .= "X-Mailer: PHP/" . phpversion();
    mail($toEmail, $subject, $message, $headers);
}

$emailer = new SendEmailFromForm;
$emailer->labelMap['name'] = "Меня зовут";
$emailer->labelMap['phone'] = "Телефон";
if (!empty($_POST['email'])) {
    $emailer->labelMap['email'] = "Электронная почта";
}
if (!empty($_POST['txt'])) {
    $emailer->labelMap['txt'] = "Комментарий";
}
if (!empty($_POST['price'])) {
    $emailer->labelMap['price'] = "Общая стоимость";
}

$text = $emailer->buildHtml();
$text = "Заказ на бухгалтерию \n\r <br/> <br/> $text ";
$emailer->sendEmail('info@booker-online.ru', 'no-reply@booker-online.ru', 'Заказ на бухгалтерию', $text,"Заказ от " . $_POST['name']);

// Add subscriber to database
$txt = $_POST['txt'];
$name = $_POST['name'];
$phone = $_POST['phone'];

sleep(1);
header ('Location: /?success=1');