<?php
    include ("ressources/handle_db.php");

        $ret = query("SELECT * FROM `product`");
        
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
                                <button type="submit" name="add" value="$row[id]" class="buy"/>Commander</button>
                            </form>  
                        </div>
                        <div class="total-price">$row[price]$</div> 
                    </div>
EOL;
            }  
        }

?>
