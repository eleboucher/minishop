<?php
include ("ressources/handle_db.php");

function check_error_form()
{
  $error = TRUE;
  if (preg_match("/^.+@.+\..+$/", $_POST['email']) == FALSE) {
    $error = "L'adresse email n'est pas valide.";
    return ($error);
  }
  else if (strlen($_POST['passwd']) < 5) {
    $error = "Le mot de passe doit faire au moins 5 caractères.";
    return ($error);
  }
  else if (preg_match('~[0-9]+~', $_POST['passwd']) == FALSE) {
    $error = "Le mot de passe doit comporter au moins un chiffre.";
    return ($error);
  }
  else if (preg_match("/^[0-9]+\s+.+\s+.+\s?$/", $_POST['address']) == FALSE) {
    $error = "L'adresse n'est pas valide.";
    return ($error);
  }
  else if (preg_match("/^[0-9]{5}$/", $_POST['postal_code']) == FALSE) {
    $error = "Le code postal n'est pas valide.";
    return ($error);
  }
  else if (preg_match("/^\+?[0-9]+$/", $_POST['phone']) == FALSE) {
    $error = "Le numéro de téléphone n'est pas valide.";
    return ($error);
  }
  if (!isset($_POST['fname']) || !isset($_POST['lname']) || !isset($_POST['email'])
  || !isset($_POST['passwd'])){
    $error = "Tous les champs obligatoires doivent être remplis.";
    return ($error);
  }
  $ret = query("SELECT * FROM `user`");
  while ($row = mysqli_fetch_assoc($ret))
  {
    if ($row['email'] === $_POST['email']) {
      $error = "L'adresse email fournie est déjà utilisée par un autre compte.";
      return ($error);
    }
  }
  return ($error);
}

$error =check_error_form();
{
  if ($error === TRUE) {
    $query = "INSERT INTO user (passwd, fname, lname, email, address, city, postal_code, phone) VALUES ('" . hash('whirlpool', $_POST['passwd']) . "', '{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['email']}', '{$_POST['address']}', '{$_POST['city']}', {$_POST['postal_code']}, '{$_POST['phone']}')";
    query($query);
    //header("Location: index.php");
  }
  else {
    echo $error."\n";
  }
}
?>
