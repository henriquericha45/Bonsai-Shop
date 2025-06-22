<?php
session_start();

if (isset($_SESSION['usuario_email'])) {
    header('Location: menu.php');
    exit;
}