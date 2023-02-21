<?php
session_start();

if(isset($_SESSION['logado'])) {
    $_SESSION['logado'] = false;
    header('Location: login');
}



?>