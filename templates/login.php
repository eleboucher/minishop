<form method="post" action="../login.php" id="connection">
    <fieldset>
        <h1>Se connecter</h1>
        <?php
        if(isset($no_co))
                echo "$no_co";
        ?>
        <label for="email">E-mail : </label><input id="email" name="email" type="email"/><br>
        <label for="passwd">Mot de passe : </label><input id="passwd" name="passwd" type="password"/><br>
        <input type="submit" class="submit" name="connection" value="Connect">
    </fieldset>
</form>
