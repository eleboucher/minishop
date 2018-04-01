<?php
    function query($query){
        $mysqli = mysqli_connect("localhost", "root", "berni196742", "minishop");
        if ($mysqli){
            $res = mysqli_query($mysqli, $query);
        }
        else
          return false;
        mysqli_close($mysqli);
        return $res;
    }
    
    function escape_string($str)
    {
        $mysqli = mysqli_connect("localhost", "root", "berni196742", "minishop");
        if ($mysqli){
            $res = mysqli_real_escape_string($mysqli, $str);
        }
        else
          return false;
        mysqli_close($mysqli);
        return $res;
    }
?>
