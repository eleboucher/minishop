<?php
include ("ressources/handle_db.php");
session_start();

function connexion($email, $hash_passwd)
{  
  $var1 = query("SELECT passwd FROM `user` WHERE email = '$email'");
  $var2 = query("SELECT email FROM `user` WHERE passwd = '$hash_passwd'");
  if (mysqli_num_rows($var1) > 0)
    $ret1 = mysqli_fetch_assoc($var1);
  if (mysqli_num_rows($var2) > 0)
    $ret2 = mysqli_fetch_assoc($var2);
  if ($ret2['email'] === $email && $ret1['passwd'] === $hash_passwd)
    return (TRUE);
  else
    return (FALSE);
}

if (isset($_POST['submit']) && $_POST['submit'] === "Login")
{
    $email = $_POST["email"];
    $hash_passwd = hash("whirlpool", $_POST["passwd"]);
    $ret = connexion($email, $hash_passwd);
    if ($ret === TRUE)
    {
        $_SESSION["logged_in"] = TRUE;
        $_SESSION["user_email"] = $_POST["email"];
        echo "Connexion réussie. Bienvenue !\n";
        //header("Location: index.php");
    }
    else
        echo "L'email ou le mot de passe est incorrect.\n";
}
?>

if ()

<form method="post" id="connection">
    <fieldset>
        <h1>Se connecter</h1>
        <label for="email">E-mail : </label><input id="email" name="email" type="email"/><br/>
        <label for="passwd">Mot de passe : </label><input id="passwd" name="passwd" type="password"/><br/>
        <input type="submit" class="submit" name="submit" value="Login" ><br/>
    </fieldset>
</form>
