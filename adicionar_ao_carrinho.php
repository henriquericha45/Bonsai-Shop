<?php
session_start();

if (!isset($_POST['id_bonsai'])) {
    echo "ID do bonsai não fornecido.";
    exit;
}

$id = (int) $_POST['id_bonsai'];

require_once 'conexao.php';
$conn = (new Conexao())->conectar();
$stmt = $conn->prepare("SELECT quantidade FROM bonsai WHERE id_bonsai = ?");
$stmt->execute([$id]);
$estoque = $stmt->fetchColumn();

if ($estoque === false) {
    echo "Produto não encontrado.";
    exit;
}

if (!isset($_SESSION['carrinho']) || !is_array($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$quantidadeAtual = $_SESSION['carrinho'][$id] ?? 0;

if ($quantidadeAtual < $estoque) {
    $_SESSION['carrinho'][$id] = $quantidadeAtual + 1;
}

setcookie('carrinho', json_encode($_SESSION['carrinho']), time() + (86400 * 7), "/");

$redirect = $_SERVER['HTTP_REFERER'] ?? 'menu.php';
header("Location: " . $redirect);
exit;
