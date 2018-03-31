<?php
    include ("ressources/handle_db.php");
    session_start();

    function remove_prod($id)
    {
        echo $id."\n";
        $index = array_search($id, array_column($_SESSION["products"], 'id'));
        echo $index."\n";
        print_r ($_SESSION["products"]);
        if ($index !== false)
            array_splice($_SESSION["products"], $index, 1);
    }
    
    if (isset($_GET["del"]) && is_numeric($_GET["del"])){
        remove_prod($_GET["del"]);
    }
    if (isset($_GET["quantity"]) && isset($_GET["id"]) && is_numeric($_GET["quantity"]) && is_numeric($_GET["id"])) {
        $index = array_search($_GET["id"], array_column($_SESSION["products"], 'id'));
        $_SESSION["products"][$index]["quantity"] = $_GET["quantity"];
    }
    $_SESSION["products"] = array(array("id" => 1, "quantity" => 1 ), array("id" => 2, "quantity" => 2 ), array("id" => 6, "quantity" => 4 ));
    if (isset($_SESSION["products"]))
    {
        foreach ($_SESSION["products"] as $product => $id) {
            $ret = query("SELECT * FROM `product` where ID = {$id["id"]}");
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
                            <form type="post" class="form1">
                                <input type="number" name="quantity" min="1" max="$row[stock]" value="1">
                                <button type="submit" name="quantity" value="$row[id]">Modifier</button>
                            </form>
                            <form type="post" class="form2">
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