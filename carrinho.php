<?php
include("header.php");
session_start();
include 'conexao.php';

try {
    $conexao = new Conexao();
    $conn = $conexao->conectar();

    if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) === 0) {
        $produtos = [];
    } else {
        // Pega os IDs do carrinho
        $ids = array_keys($_SESSION['carrinho']);
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $stmt = $conn->prepare("SELECT * FROM bonsai WHERE id_bonsai IN ($placeholders)");
        $stmt->execute($ids);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    error_log("Erro ao carregar carrinho: " . $e->getMessage());
    die("Erro ao carregar os produtos do carrinho.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <style>
        body {
            background-color: #1f1f1f;
            font-family: Arial, sans-serif;
            color: #eaeaea;
            margin: 0;
            padding: 0;
        }

        .catalogo {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
            align-items: start;
            justify-content: center;
        }

        .produto {
            background-color: #2b2b2b;
            border: 1px solid #444;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: auto;
            min-height: 420px;
            max-width: 280px;
            margin: 0 auto;
        }

        .imagem-produto {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 12px;
        }

        .preco {
            color: #2ecc71;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .quantidade {
            font-size: 0.9rem;
            color: #aaa;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin-top: 30px;">🛒 Itens no Carrinho</h1>
    <?php if (empty($produtos)): ?>
        <p style='color: white; text-align: center; margin-top: 40px;'>🛒 Seu carrinho está vazio.</p>
    <?php else: ?>
    <div class="catalogo">
        <?php foreach ($produtos as $p): ?>
            <div class="produto">
                <img class="imagem-produto" src="<?= htmlspecialchars($p['image_dir']) ?>" alt="<?= htmlspecialchars($p['nome']) ?>">
                <h3><?= htmlspecialchars($p['nome']) ?></h3>
                <p><?= htmlspecialchars($p['descricao']) ?></p>
                <p class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
                <p class="quantidade">Quantidade: <?= $_SESSION['carrinho'][$p['id_bonsai']] ?></p>
                <form action="remover_do_carrinho.php" method="post">
                    <input type="hidden" name="id_bonsai" value="<?= $p['id_bonsai'] ?>">
                    <button type="submit" style="margin-top: 10px; background-color: #e74c3c; border: none; color: #fff; padding: 8px 12px; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%;">Remover do Carrinho</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</body>
</html>