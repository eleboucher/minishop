<?php
    function query($query){
        $mysqli = mysqli_connect("localhost", "root", "berni196742", "minishop");
        if ($mysqli){
            $res = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli));
        }
        else
          return false;
        mysqli_close($mysqli);
        return $res;
    }
?>
