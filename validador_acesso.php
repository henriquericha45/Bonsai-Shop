<?php

session_start();

if(isset($_SESSION['logado'])) {
    if($_SESSION['logado'] == true) {
        header("Location: menu.php");
    } else {
        header("Location: login.php");
    }

}

?>