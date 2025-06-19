<?php
session_start();

// Garante que o ID foi enviado
if (!isset($_POST['id_bonsai'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_POST['id_bonsai'];

// Inicializa o carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Se o produto já estiver no carrinho, aumenta a quantidade
if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id]++;
} else {
    $_SESSION['carrinho'][$id] = 1;
}

// Redireciona de volta (ou para o carrinho se preferir)
header("Location: menu.php");
exit;