<?php
    session_start();
    if (isset($_SESSION['login_id'])){
        
    }
    else
    {
        echo "Vous devez etre connecté pour pouvoir commander!";
    }
?>