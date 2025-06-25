<?php
session_start();

if (isset($_POST['id_bonsai'])) {
    $id = (int) $_POST['id_bonsai'];

    if (isset($_SESSION['carrinho'][$id])) {
        if ($_SESSION['carrinho'][$id] > 1) {
            $_SESSION['carrinho'][$id]--;
        } else {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    setcookie(
        'carrinho',
        json_encode($_SESSION['carrinho']),
        time() + (86400 * 7),
        "/"
    );
}

header("Location: carrinho.php");
exit;