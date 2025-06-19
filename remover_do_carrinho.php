

<?php
session_start();

// Verifica se o ID foi enviado
if (isset($_POST['id_bonsai'])) {
    $id = (int) $_POST['id_bonsai'];

    // Se o item existir no carrinho, remove
    if (isset($_SESSION['carrinho'][$id])) {
        unset($_SESSION['carrinho'][$id]);
    }
}

// Redireciona de volta para o carrinho
header("Location: carrinho.php");
exit;
?>