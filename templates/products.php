<?php
    include ("../handle_db.php");
    $ret = query("SELECT * FROM `product`");

    if (mysqli_num_rows($ret) > 0) {
        echo "<ul>";
        while($row = mysqli_fetch_assoc($ret)) {
            echo <<<EOL
                <li>
                    <img src="$row[img]"></img>
                    <h5>$row[name]</h5>
                    <p>$row[description]</p>
                    <p>$row[price]<p>
                    <p>$row[stock]<p>
                </li>
EOL;
        }
        echo "<ul>";
    }
?>
