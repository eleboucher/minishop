<?php
    function query($query){
        $mysqli = mysqli_connect("localhost", "root", "azerty", "minishop");
        if ($mysqli){
            $res = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        }
        else 
            return false;
        mysqli_close($mysqli);
        return $res;
    }
?>