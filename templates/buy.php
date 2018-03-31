<?php
    include ("handle_db.php");
    session_start();
    $_SESSION['login_id'] = 1;
    if (isset($_SESSION['login_id'])){
        date_default_timezone_set('Europe/Paris');
        $timestamp = date("Y-m-d H:i:s",  time());
        query("INSERT INTO `order` (`user_id`, `date`) VALUES ('$_SESSION[login_id]', '$timestamp')");
        foreach($_SESSION["products"] as $prod){
            query("INSERT INTO `order_item` (`order_id`, `product_id`, `quantity`) VALUES ((SELECT order.id FROM `order` WHERE ( `date` = '$timestamp' AND `user_id` = '$_SESSION[login_id]' ) limit 1), $prod[id], $prod[quantity])");
        }
    }
    else{
        echo "Vous devez etre connecté pour pouvoir commander!";
    }
?>