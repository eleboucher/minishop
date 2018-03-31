<?php
include ("ressources/handle_db.php");

session_start();
if ($_POST['submit'] === "Delete")
{
  if ($_SESSION["logged_in"] === TRUE)
  {
    $delete = "DELETE FROM `user` WHERE email = '$_SESSION[user_email]'";
    query($delete);
    $_SESSION["user"] = NULL;
    //header("Location: index.php");
  }
}
?>
