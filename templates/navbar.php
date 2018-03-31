<nav>
  <ul>
    <li><a <?php if($_SERVER['SCRIPT_NAME']=="/index.php") { ?>  class="active"   <?php } ?> href="index.php">Accueil</a></li>
    <li><a <?php if($_SERVER['SCRIPT_NAME']=="/products.php") { ?>  class="active"   <?php } ?> href="product.php">Produit</a></li>
    <li style="float:right"><a <?php if($_SERVER['SCRIPT_NAME']=="/account.php") { ?>  class="active"   <?php } ?> href="account.php">Compte</a></li>
    <li style="float:right"><a <?php if($_SERVER['SCRIPT_NAME']=="/cart.php") { ?>  class="active"   <?php } ?> href="cart.php">Panier</a></li>
  </ul>
</nav>