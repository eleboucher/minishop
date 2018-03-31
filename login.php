<?php
include ("handle_db.php");
include ("templates/head.php");

function connexion($email, $passwd)
{
  $var1 = query("SELECT passwd FROM `user` WHERE email=$email");
  $var2 = query("SELECT email FROM `user` WHERE passwd=$passwd");
  if ($var2 === $email && $var1 === $passwd)
    return (TRUE);
  else
    return (FALSE);
}

session_start();
$ret = connexion($_POST['email'], $_POST['passwd']);
if ($ret === TRUE)
  {
    $_SESSION["logged_in"] = TRUE;
    echo "Connexion réussie. Bienvenue\n";
    //header("Location: index.html");
  }
else
  echo "L'email ou le mot de passe est incorrect.\n";
?>
