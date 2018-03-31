<?php
    include ("handle_db.php");
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
        echo "<ul>";
        foreach ($_SESSION["products"] as $product => $id) {
            $ret = query("SELECT * FROM `product` where ID = {$id["id"]}");
            if (mysqli_num_rows($ret) > 0) {
                
                while($row = mysqli_fetch_assoc($ret)) {
                    echo <<<EOL
                        <li>
                            <img src="$row[img]" width="50vw" height="50vw" alt="$row[name]"></img>
                            <h5>$row[name]</h5>
                            <p>$row[description]</p>
                            <p>$row[price]<p>
                            <p>$row[stock]<p>
                            <form type="get">
                                <input type="number" name="quantity" min="1" max="$row[stock]" value="$id[quantity]">
                                <button type="submit" name="id" value="$id[id]">Modifier</button>
                                
                            </form>
                            <form type="get">
                                <button type="submit" name="del" value="$id[id]"/>Supprimer</button>
                            </form>
                           

                        </li>
EOL;
                }
                  
            }
        }
        echo "<ul>";  

        echo <<<EOL
        <form action="buy.php">
            <button type="submit" "/>Commander</button>
        </form>
EOL;
    }

?>