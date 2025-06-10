<?php
session_start();

if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit;
}
?>