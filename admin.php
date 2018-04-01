<html>
<head>
    <title>Page administrateur</title>
     <link rel="stylesheet" type="text/css" href="public/css/style.css">
     <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<?php include("templates/navbar.php")?>
  <div class="section">
    <?php 
        if(!isset($_SESSION)){ 
          session_start(); 
      } 
      if (isset($_SESSION['login_id']) && $_SESSION['login_id'] == 1) {
        include ("templates/admin.php"); 
      }
      else
        echo "Vous n'etes pas admin.";

    ?>
  </div>
</body>
</html>
