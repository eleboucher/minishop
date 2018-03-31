<form method="post" action="../create.php" id="create_account">
  <fieldset>
    <?php
    if(isset($error))
    {
      if ($error == TRUE)
        echo "Votre compte a été créé avec succès\n";
      else
        echo $error."\n";
    }
    ?>
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

<form method="post" action="../delete.php" id="delete">
  <p>Pour supprimer votre compte actuel, rentrez "Supprimer" dans le champ ci-dessous</p>
  <input type="submit" class="submit" name="delete" value="Delete"/>
</form>
