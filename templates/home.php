<?php
    include_once ("ressources/handle_db.php");
    $mostarticle_q = query("SELECT product_id, SUM(quantity) AS totalQuantity FROM order_item GROUP BY product_id ORDER BY SUM(quantity) DESC LIMIT 3 ");
    if (mysqli_num_rows($mostarticle_q) > 0) {
        echo '<div class="showcase">';
        while($mostarticle = mysqli_fetch_assoc($mostarticle_q)) {
            $item_q = query("SELECT * FROM product where id = $mostarticle[product_id]");
            if (mysqli_num_rows($item_q) > 0) {
                while($item = mysqli_fetch_assoc($item_q)) {
                    echo <<<EOL
                    <div class="item-showcase">
                        <div class="image">
                         <img src="$item[img]" alt="$item[name]"></img>
                        </div>
                        <div class="description">
                            <span>$item[name]</span>
                            <span>quantité acheté : <i>$mostarticle[totalQuantity]</i></span>
                        </div>
                    </div>
EOL;
                }
            }
        }
        echo '</div>';
    }
?>