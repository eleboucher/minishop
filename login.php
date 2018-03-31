<?php
include ("handle_db.php");
include ("templates/head.php");

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

session_start();
$email = $_POST["email"];
$hash_passwd = hash("whirlpool", $_POST["passwd"]);
$ret = connexion($email, $hash_passwd);
if ($ret === TRUE)
  {
    $_SESSION["logged_in"] = TRUE;
    $_SESSION["user_email"] = $_POST["email"];
    echo "Connexion réussie. Bienvenue !\n";
  //  header("Location: index.php");
  }
else
  echo "L'email ou le mot de passe est incorrect.\n";
?>
