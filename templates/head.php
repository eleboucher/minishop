<?php
    function get_head($title){
        echo <<<EOT
        <title>$title</title>
        <meta charset="utf8"/>
EOT;
    }
?>