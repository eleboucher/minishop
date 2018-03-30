<?php
    function query($query){
        $mysqli = mysqli_connect("localhost", "root", "azerty", "minishop");
        if ($mysqli){
            $res = mysqli_query($mysqli, $query);
        }
        else 
            return false;
        mysqli_close($mysqli);
        return $res;
    }
?>