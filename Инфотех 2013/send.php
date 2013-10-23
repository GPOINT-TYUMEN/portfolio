<?php

$adminemail="infotex@72to.ru, timkinaes@72to.ru, aggr@yandex.ru";  // e-mail админа

$date=date("d.m.y"); // число.месяц.год

$time=date("H:i"); // часы:минуты:секунды

$backurl="/";  // На какую страничку переходит после отправки письма

//---------------------------------------------------------------------- //

 

// Принимаем данные с формы

$last_name=$_POST['last_name'];

$name=$_POST['name'];

$middle_name=$_POST['middle_name'];

$agency=$_POST['agency'];

$position=$_POST['position'];

$region=$_POST['region'];

$city=$_POST['city'];

$phone=$_POST['phone'];

$email=$_POST['email'];

$section=$_POST['section'];

$theme=$_POST['theme'];

$time=$_POST['time'];

$shape=$_POST['shape'];

$length_1=$_POST['length_1'];

$length_2=$_POST['length_2'];

$comment=$_POST['comment'];

$transfer_text=$_POST['transfer_text'];

$question=$_POST['question'];

$msg=$_POST['message'];

// Проверяем валидность e-mail

if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is",
strtolower($email)))

 {

  echo "<center>Вернитесь <a href='javascript:history.back(1)'><strong>назад</strong></a>. Вы указали неверные данные!";

  }

 else

 {


$msg="
Фамилия: $last_name

Имя: $name

Отчество: $middle_name

Организация: $agency

Должность: $position

Регион: $region

Город: $city

Телефон: $phone

Эл. почта: $email

Выступаю с докладом в секции: $section

Тема доклада: $theme

Время доклада: $time

Форма участия: $shape

Площадь: длина - $length_1 метров, ширина - $length_2 метров

Комментарий: $comment

Трансфер: $transfer_text

Откуда вы узнали о мероприятии: $question

Комментарий: $msg

";

 

 // Отправляем письмо админу 

mail("$adminemail", "$date Заявка на инфотех 2013 от $name $last_name", "$msg");

 

// Сохраняем в базу данных

$f = fopen("message.txt", "a+");

fwrite($f," \n $date $time Сообщение от $name");

fwrite($f,"\n $msg ");

fwrite($f,"\n ---------------");

fclose($f);


// Выводим сообщение пользователю

print "<script language='Javascript'><!--
function reload() {location = \"$backurl\"}; setTimeout('reload()', 1000);
//--></script>

$msg

<p>Сообщение отправлено! Подождите, сейчас вы будете перенаправлены на главную страницу...</p>"; 
exit;

 }