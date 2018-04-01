<?php
  if (!isset($_SESSION))
  {
    session_start();
  }
?>
  <nav>
    <ul>
      <li><a <?php if($_SERVER['SCRIPT_NAME']=="/index.php") { ?>  class="active"   <?php } ?> href="index.php">Accueil</a></li>
      <li><a <?php if($_SERVER['SCRIPT_NAME']=="/products.php") { ?>  class="active"   <?php } ?> href="product.php">Produit</a></li>
      <?php
          if (isset($_SESSION['login_id']) && $_SESSION['login_id'] == 1) {
            ?> 
            <li style="float:right"><a <?php if($_SERVER['SCRIPT_NAME']=="/admin.php") { ?>  class="active"   <?php } ?> href="admin.php">Admin</a></li>
      <?php
          }
      ?>
      <li style="float:right"><a <?php if($_SERVER['SCRIPT_NAME']=="/account.php") { ?>  class="active"   <?php } ?> href="account.php">Compte</a></li>
      <li style="float:right"><a <?php if($_SERVER['SCRIPT_NAME']=="/cart.php") { ?>  class="active"   <?php } ?> href="cart.php">Panier</a></li>

    </ul>
  </nav>
