<?php
include_once ("ressources/handle_db.php");
if(!isset($_SESSION)) {
    session_start(); 
}
    function remove_prod($id)
    {
        echo $id."\n";
        $index = array_search($id, array_column($_SESSION["products"], "id"));
        echo $index."\n";
        print_r ($_SESSION["products"]);
        if ($index !== false)
            array_splice($_SESSION["products"], $index, 1);
    }
    
    if (isset($_POST["del"]) && is_numeric($_POST["del"])){
        remove_prod($_POST["del"]);
    }
    if (isset($_POST["quantity"]) && isset($_POST["id"]) && is_numeric($_POST["quantity"]) && is_numeric($_POST["id"])) {
        $index = array_search($_POST["id"], array_column($_SESSION["products"], "id"));
        $_SESSION["products"][$index]["quantity"] = $_POST["quantity"];
    }
    //$_SESSION["products"] = array(array("id" => 1, "quantity" => 1 ), array("id" => 2, "quantity" => 2 ), array("id" => 6, "quantity" => 4 ));
    if (isset($_SESSION["products"]))
    {
        foreach ($_SESSION["products"] as $product => $id) {
            $ret = query("SELECT * FROM `product` where id = $id[id] ");
            if (mysqli_num_rows($ret) > 0) {
                
                while($row = mysqli_fetch_assoc($ret)) {
                    echo <<<EOL
                    <div class="item">
                    <div class="image">
                            <img src="$row[img]" alt="$row[name]"></img>
                        </div>
                        <div class="description">
                            <span>$row[name]</span>
                            <span>$row[description]</span>
                        </div>
                       
                        <div class="button">
                            <form method="post" class="form1">
                                <input type="number" name="quantity" min="1" max="$row[stock]" value="$id[quantity]"">
                                <button type="submit" name="quantity" value="$row[id]">Modifier</button>
                            </form>
                            <form method="post" class="form2">
                            <button type="submit" name="del" value="$id[id]"/>Supprimer</button>
                            </form>  
                        </div>
                        <div class="total-price">$row[price]$</div> 
                    </div>
EOL;
                }
                  
            }
        } 

        echo <<<EOL
        <form action="buy.php" style="float:right;">
            <button type="submit" class="buy">Commander</button>
        </form>
EOL;
    }

?>