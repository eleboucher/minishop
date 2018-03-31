<?php
include ("handle_db.php");
session_start();
echo "c";
if ($_SESSION["logged_in"] === TRUE)
{
  $ret = query("SELECT * FROM `user` WHERE email = '$_SESSION[user_email]'");
  if (mysqli_num_rows($ret) > 0) {
    echo "<ul>";
    while($row = mysqli_fetch_assoc($ret)) {
      echo <<<EOL
      <li>
      <p>$row[fname]</p>
      <p>$row[lname]</p>
      <p>$row[email]</p>
      <p>$row[address]</p>
      <p>$row[city]</p>
      <p>$row[code_postal]</p>
      <p>$row[phone]<p>
      </li>
EOL;
    }
  echo "<ul>";
  }
}
else
  echo "Aucun utilisateur n'est actuellement connecté.\n";
?>
