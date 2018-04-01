<?php
include ("ressources/handle_db.php");
session_start();

function check_error_form_change()
{
  $error = TRUE;
  if (preg_match("/^.+@.+\..+$/", $_POST['email']) == FALSE) {
    $error = "L'adresse email n'est pas valide.";
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
}

if ($_POST['submit'] == "Change")
{
  $error = check_error_form_change();
  if ($error === TRUE)
  {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $phone = $_POST['phone'];
    $change = "UPDATE `user` SET fname = $fname, lname = $lname, email = $email, address = $address, city = $city, postal_code = $postal_code, phone = $phone WHERE email = '$_SESSION[user_email]'";
    query($change);
    $_SESSION['user_email'] = $_POST['email'];
    echo "Votre compte a été modifié avec succès.\n";
  }
  else
    echo $error."\n";
}
if ($_SESSION["logged_in"] === TRUE)
{
      ?>
      <form method="post" id="change_account">
        <fieldset>
          <?php
          $ret = query("SELECT * FROM `user` WHERE email = '$_SESSION[user_email]'");
          if (mysqli_num_rows($ret) > 0) {
            while($row = mysqli_fetch_assoc($ret)) {
              echo <<<EOL
          <h1>Modifiez votre compte</h1>
          <label for="fname">Prénom : </label><input id="fname" name="fname" type="text" value="$row[fname]"/><br/>
          <label for="lname">Nom : </label><input id="lname" name="lname" type="text" value="$row[lname]"/><br/>
          <label for="email">E-mail : </label><input id="email" name="email" type="email" value="$row[email]"/><br/>
          <label for="address">Adresse : </label><input id="address" name ="address" type="text" value="$row[address]"/><br/>
          <label for="city">Ville : </label><input id="city" name ="city" type="text" value="$row[city]"/><br/>
          <label for="postal_code">Code postal : </label><input id="postal_code" name="postal_code" type="text" value="$row[postal_code]"/><br/>
          <label for="phone">Téléphone : </label><input id="phone" name="phone" type="tel" value="$row[phone]"/><br/>
          <input type="submit" class="submit" name="submit" value="Change" ><br/>
EOL
?>
</fieldset>
</form>
<?php
     }
    }
}
else
  echo "Aucun utilisateur n'est actuellement connecté.\n";
?>
