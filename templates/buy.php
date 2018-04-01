<?php
include_once ("ressources/handle_db.php");
    if(!isset($_SESSION)){ 
        session_start(); 
    } 
    function remove_prod($id)
    {
        $index = array_search($id, array_column($_SESSION["products"], "id"));
        if ($index !== false)
            array_splice($_SESSION["products"], $index, 1);
    }

    if (isset($_SESSION['login_id']) && isset($_SESSION["products"]) && $_SESSION["products"] != NULL){
        date_default_timezone_set('Europe/Paris');
        $timestamp = date("Y-m-d H:i:s",  time());
        foreach($_SESSION["products"] as $prod){
            $test = query("SELECT * FROM product where id = $prod[id]");
            if (mysqli_num_rows($test) == 0)
            {
                remove_prod($prod["id"]);
                exit("error");
            }
        }
        query("INSERT INTO `order` (`user_id`, `date`) VALUES ('$_SESSION[login_id]', '$timestamp')");
        foreach($_SESSION["products"] as $prod){
            query("INSERT INTO `order_item` (`order_id`, `product_id`, `quantity`) VALUES ((SELECT order.id FROM `order` WHERE ( `date` = '$timestamp' AND `user_id` = '$_SESSION[login_id]' ) limit 1), $prod[id], $prod[quantity])");
        }
        $_SESSION["products"] = NULL;
    }
    else if (!isset($_SESSION['login_id'])) {
        echo "Vous devez etre connecté pour pouvoir commander!";
    }
    else if (!isset($_SESSION["products"]) || $_SESSION["products"] == NULL){
        echo "panier vide";
    }
?>