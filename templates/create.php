<?php
include_once ("ressources/handle_db.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

function check_error_form()
{
  $error = TRUE;
  $email = mysqli_real_escape_string($_POST['email']);
  $passwd = mysqli_real_escape_string($_POST['passwd']);
  $address = mysqli_real_escape_string($_POST['address']);
  $postal_code = mysqli_real_escape_string($_POST['postal_code']);
  $phone = mysqli_real_escape_string($_POST['phone']);
  $fname = mysqli_real_escape_string($_POST['fname']);
  $lname = mysqli_real_escape_string($_POST['lname']);
  if (preg_match("/^.+@.+\..+$/", $email) == FALSE) {
    $error = "L'adresse email n'est pas valide.";
    return ($error);
  }
  else if (strlen($passwd) < 5) {
    $error = "Le mot de passe doit faire au moins 5 caractères.";
    return ($error);
  }
  else if (preg_match('~[0-9]+~', $passwd) == FALSE) {
    $error = "Le mot de passe doit comporter au moins un chiffre.";
    return ($error);
  }
  else if (preg_match("/^[0-9]+\s+.+\s+.+\s?$/", $address) == FALSE) {
    $error = "L'adresse n'est pas valide.";
    return ($error);
  }
  else if (preg_match("/^[0-9]{5}$/", $postal_code) == FALSE) {
    $error = "Le code postal n'est pas valide.";
    return ($error);
  }
  else if (preg_match("/^\+?[0-9]+$/", $phone) == FALSE) {
    $error = "Le numéro de téléphone n'est pas valide.";
    return ($error);
  }
  if (!isset($fname) || !isset($lname) || !isset($email)
  || !isset($passwd) || $fname === "" || $lname === "" || $email === "" || $passwd === ""){
    $error = "Tous les champs obligatoires doivent être remplis.";
    return ($error);
  }
  $ret = query("SELECT * FROM `user`");
  while ($row = mysqli_fetch_assoc($ret))
  {
    if ($row['email'] === $email) {
      $error = "L'adresse email fournie est déjà utilisée par un autre compte.";
      return ($error);
    }
  }
  return ($error);
}

if (isset($_POST['submit']) && $_POST['submit'] === "Submit")
{
  $error = check_error_form();
  {
    if (isset($error) && $error === TRUE) {
      $email = mysqli_real_escape_string($_POST['email']);
      $passwd = mysqli_real_escape_string($_POST['passwd']);
      $address = mysqli_real_escape_string($_POST['address']);
      $postal_code = mysqli_real_escape_string($_POST['postal_code']);
      $phone = mysqli_real_escape_string($_POST['phone']);
      $fname = mysqli_real_escape_string($_POST['fname']);
      $lname = mysqli_real_escape_string($_POST['lname']);
      $city = mysqli_real_escape_string($_POST['city']);
      $query = "INSERT INTO `user` (passwd, fname, lname, email, address, city, postal_code, phone) VALUES ('" . hash('whirlpool', $passwd) . "', '$fname', '$lname', '$email', '$address', '$city', '$postal_code', '$phone')";
      query($query);
      echo "Votre compte a été créé avec succès.\n";
      //header("Location: index.php");
    }
    else if (isset($error)) {
      echo '<script> alert("'.$error.'");</script>';
    }
  }
}

?>

<form method="post" id="create_account">
  <fieldset>
    <h1>Créer un compte</h1>
    <label for="fname">Prénom : </label><input id="fname" name="fname" type="text"/><br/>
    <label for="lname">Nom : </label><input id="lname" name="lname" type="text"/><br/>
    <label for="email">E-mail : </label><input id="email" name="email" type="email"/><br/>
    <label for="passwd">Mot de passe : </label><input id="passwd" type="password" name="passwd"/><br/>
    <label for="address">Adresse : </label><input id="address" name ="address" type="text"/><br/>
    <label for="city">Ville : </label><input id="city" name ="city" type="text"/><br/>
    <label for="postal_code">Code postal : </label><input id="postal_code" name="postal_code" type="text"/><br/>
    <label for="phone">Téléphone : </label><input id="phone" name="phone" type="tel"/><br/>
    <input type="submit" class="submit" name="submit" value="Submit" ><br/>
  </fieldset>
</form>
