<html>
<head>
    <title>Modifier son compte</title>
     <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
  <?php include ("templates/navbar.php"); ?>
    <div class="section">
      <?php include ("templates/whoami.php"); ?>
      <form method="post" action="templates/login.php" id="connection">
          <input type="submit" class="submit" name= "submit" value="Se déconnecter"/>
      </form>

      <form method="post" id="delete">
        <p>Pour supprimer votre compte actuel, appuyez sur le bouton ci-dessous</p>
        <input type="submit" class="submit" name="submit" value="Delete"/>
      </form>

      <h3>Order:</h3>
      <?php include ("templates/order.php"); ?>
    </div>
    <?php include("templates/footer.php")?>
</body>
</html>
