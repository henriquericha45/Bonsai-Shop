<?php
include("header.php");
session_start();

if (!isset($_SESSION['carrinho']) && isset($_COOKIE['carrinho'])) {
    $data = json_decode($_COOKIE['carrinho'], true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
        $_SESSION['carrinho'] = $data;
    } else {
        setcookie('carrinho', '', time() - 3600, "/");
        $_SESSION['carrinho'] = [];
    }
}

include 'conexao.php';
$conexao = new Conexao();
$conn = $conexao->conectar();

if (empty($_SESSION['carrinho'])) {
    $produtos = [];
} else {
    $ids = array_keys($_SESSION['carrinho']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $conn->prepare("SELECT * FROM bonsai WHERE id_bonsai IN ($placeholders)");
    $stmt->execute($ids);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        .controles-quantidade {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #333;
            border: 1px solid #555;
            border-radius: 8px;
            margin: 12px auto 0;
            padding: 6px 8px;
            width: fit-content;
        }
        .controles-quantidade form {
            margin: 0;
        }
        .controles-quantidade button {
            background-color: #444;
            border: none;
            color: #eaeaea;
            font-size: 1.2rem;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .controles-quantidade button:hover {
            background-color: #555;
        }
        .controles-quantidade button svg {
            fill: #e74c3c;
            width: 16px;
            height: 16px;
        }
        .controles-quantidade span {
            min-width: 24px;
            text-align: center;
            color: #eaeaea;
            font-weight: bold;
            margin: 0 6px;
        }
        .finalizar-topo {
            background-color: #2ecc71;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 16px 0;
            text-align: center;
            text-decoration: none;
            display: block;
            width: 100%;
            margin: 0;
            position: relative;
            top: -16px;
            z-index: 1;
            border: none;
            cursor: pointer;
        }

        .finalizar-topo:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin-top: 30px;">🛒 Itens no Carrinho</h1>
    <?php if (!empty($produtos)): ?>
        <div style="display: flex; justify-content: space-between; align-items: center; background-color: #2ecc71; padding: 16px; margin-top: -16px;">
            <div style="color: white; font-weight: bold; font-size: 1.2rem;">
                Total: 
                R$ <?= number_format(array_sum(array: array_map(fn($p) => $p['preco'] * $_SESSION['carrinho'][$p['id_bonsai']], $produtos)), 2, ',', '.') ?>
            </div>
            <form action="checkout.php" method="post" style="margin: 0;">
                <button type="submit" class="finalizar-topo" style="width: auto; padding: 12px 12px; margin: 0; position: static;">
                    Finalizar Compra
                </button>
            </form>
        </div>
    <?php endif; ?>
    <?php if (empty($produtos)): ?>
        <p style="color: white; text-align: center; margin-top: 40px;">🛒 Seu carrinho está vazio.</p>
    <?php else: ?>
        <div class="catalogo">
            <?php foreach ($produtos as $p): ?>
                <div class="produto">
                    <img class="imagem-produto" src="<?= htmlspecialchars($p['image_dir']) ?>" alt="<?= htmlspecialchars($p['nome']) ?>">
                    <h3><?= htmlspecialchars($p['nome']) ?></h3>
                    <p><?= htmlspecialchars($p['descricao']) ?></p>
                    <p class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
                    <div class="controles-quantidade">
                        <form action="remover_do_carrinho.php" method="post">
                            <input type="hidden" name="id_bonsai" value="<?= $p['id_bonsai'] ?>">
                            <button type="submit">
                                <?php if ($_SESSION['carrinho'][$p['id_bonsai']] > 1): ?>
                                    &minus;
                                <?php else: ?>
                                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 6h18v2H3V6zm2 3h14l-1.5 12.5c-.1.8-.8 1.5-1.6 1.5H8.1c-.8 0-1.5-.7-1.6-1.5L5 9zm5 2v8h2v-8h-2zm4 0v8h2v-8h-2z"/>
                                    </svg>
                                <?php endif; ?>
                            </button>
                        </form>
                        <span><?= $_SESSION['carrinho'][$p['id_bonsai']] ?></span>
                        <?php if ($_SESSION['carrinho'][$p['id_bonsai']] < $p['quantidade']): ?>
                            <form action="adicionar_ao_carrinho.php" method="post">
                                <input type="hidden" name="id_bonsai" value="<?= $p['id_bonsai'] ?>">
                                <button type="submit">+</button>
                            </form>
                        <?php else: ?>
                            <button disabled style="background-color: #666; cursor: not-allowed;">+</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>