<?php
  session_start();
  if ($_SESSION["logged_in"] === TRUE)
    echo $_SESSION["logged_on_user"]."\n";
  else
    echo "Aucun utilisateur n'est actuellement connecté.\n";
?>
