<?php
include ("ressources/handle_db.php");
session_start();

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

if (isset($_POST['submit']) && $_POST['submit'] === "Submit")
{
  $error = check_error_form();
  {
    if (isset($error) && $error === TRUE) {
      $query = "INSERT INTO `user` (passwd, fname, lname, email, address, city, postal_code, phone) VALUES ('" . hash('whirlpool', $_POST['passwd']) . "', '{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['email']}', '{$_POST['address']}', '{$_POST['city']}', '{$_POST['postal_code']}', '{$_POST['phone']}')";
      query($query);
      echo "Votre compte a été créé avec succès.\n";
      //header("Location: index.php");
    }
    else if (isset($error)) {
      echo $error."\n";
    }
  }
}

if (isset($_POST['submit']) && $_POST['submit'] === "Delete")
{
  if ($_SESSION["logged_in"] === TRUE)
  {
    $delete = "DELETE FROM `user` WHERE email = '$_SESSION[user_email]'";
    query($delete);
    $_SESSION["user"] = NULL;
    echo "Votre compte a été supprimé avec succès.\n";    
    header("Location: index.php");
  }
  else
    echo "Aucun compte n'est actuallement connecté.\n";
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

<form method="post" id="delete">
  <p>Pour supprimer votre compte actuel, appuyez sur le bouton ci-dessous</p>
  <input type="submit" class="submit" name="submit" value="Delete"/>
</form>
