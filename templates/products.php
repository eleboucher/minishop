<?php
    if (isset($_SESSION)) {
        session_start();
    }
    if (isset($_POST["add"]) && is_numeric($_POST["add"]) && isset($_POST["quantity"]) && is_numeric($_POST["quantity"])){
        if (isset($_SESSION["products"])){
            $index = array_search($_POST["add"], array_column($_SESSION["products"], "id"));
            if ($index === false)
                $_SESSION["products"][] = array("id" => $_POST["add"], "quantity" => $_POST["quantity"]);
            else
                $_SESSION["products"][$index] = array("id" => $_POST["add"], "quantity" => $_POST["quantity"]);
        }
        else
        {
            $_SESSION["products"] = array(array("id" => $_POST["add"], "quantity" => $_POST["quantity"]));
        }
    }
    include ("ressources/handle_db.php");

    $ret = query("SELECT * FROM `category`");
    echo <<<EOL
        <form method="get">
        <select name="category">
            <option value="all">toute</option>
EOL;
    if (mysqli_num_rows($ret) > 0) {
        while($row = mysqli_fetch_assoc($ret)) {
            echo <<<EOL
            <option value="$row[name]">$row[name]</option>
EOL;
        }
    }
    echo <<<EOL
    <input type='submit' name='submit' value="valider"/>
    </select>
    </form">
EOL;
    
    if (isset($_GET['category']) && isset($_GET['submit']) && $_GET['submit'] = "valider")
    {
        if ($_GET['category'] == "all")
            $category = "all";
        else
            $category = $_GET['category'];
    }
    else{
        $category = "all";
    }

    if ($category == "all")
        $cat = query("SELECT product_id from category_map");
    else 
        $cat = query("SELECT product_id from category_map where category_id = (select category.id from category where category.name = '$category')");
    echo '<div class="shopping-list">';
    if (mysqli_num_rows($cat) > 0) {
        while($categories = mysqli_fetch_assoc($cat)) {

        $ret = query("SELECT * FROM `product` WHERE product.id  = '$categories[product_id]'");
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
                                    <input type="number" name="quantity" min="1" max="$row[stock]" value="1">
                                    <button type="submit" name="add" value="$row[id]" class="buy"/>Commander</button>
                                </form>  
                            </div>
                            <div class="total-price">$row[price]$</div> 
                        </div>
EOL;
                }  
            }
        }
        }
    echo '</div>';
?>
