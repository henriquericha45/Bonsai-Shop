<?php
session_start();
include 'conexao.php';

try {
    $conexao = new Conexao();
    $conn = $conexao->conectar();

    $stmt = $conn->prepare("SELECT * FROM bonsai WHERE quantidade > 0");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("Erro ao buscar produtos: " . $e->getMessage());
    die("Erro ao carregar os produtos.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Bonsais</title>
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
        }

        .produto {
            background-color: #2b2b2b;
            border: 1px solid #444;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.2s, box-shadow 0.3s;
        }

        .produto:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.4);
        }

        .imagem-produto {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 12px;
        }

        .produto h3 {
            font-size: 1.1rem;
            margin: 8px 0 4px;
            color: #fff;
        }

        .produto p {
            margin: 6px 0;
            font-size: 0.95rem;
            color: #ccc;
        }

        .preco {
            color: #2ecc71;
            font-size: 1.1rem;
            font-weight: bold;
        }

        form button {
            margin-top: 10px;
            background-color: #2ecc71;
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            display: block;
            box-sizing: border-box;
            transition: background-color 0.2s;
        }

        form button:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="catalogo">
        <?php foreach ($produtos as $p): ?>
            <div class="produto">
                <img class="imagem-produto" src="<?= htmlspecialchars($p['image_dir']) ?>" alt="<?= htmlspecialchars($p['nome']) ?>">
                <h3><?= htmlspecialchars($p['nome']) ?></h3>
                <p><?= htmlspecialchars($p['descricao']) ?></p>
                <p class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
                <p>Estoque: <?= (int)$p['quantidade'] ?> unidade(s)</p>
                <?php if (isset($_SESSION['usuario_email'])): ?>
                    <form method="POST" action="adicionar_ao_carrinho.php">
                        <input type="hidden" name="id_bonsai" value="<?= (int)$p['id_bonsai'] ?>">
                        <button type="submit">Adicionar ao Carrinho</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>