<?php
    // --DICIONÁRIO DE ERROS--
    // 1 = algum campo vazio
    // 2 = senhas diferentes
    // 3 = email duplicado

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        
        if(empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["telefone"]) || empty($_POST["senha"]) || empty($_POST["confirmaSenha"])) {
            header('Location: cadastro?erro=1');
            exit;
        } else if(!empty($_POST["senha"]) && !empty($_POST["confirmaSenha"]) && $_POST["senha"] != $_POST["confirmaSenha"]) {
            header('Location: cadastro?erro=2');
            exit;
        }
        // Conecta ao banco
        require_once "conexao.php";
        $conn = (new Conexao())->conectar();

        // Sanitiza e prepara dados
        $nome = trim($_POST["nome"]);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $telefone = trim($_POST["telefone"]);
        $senha_hash = password_hash($_POST["senha"], PASSWORD_DEFAULT);

        // Verifica se email já existe
        $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            header('Location: cadastro?erro=3');
            exit;
        }

        // Insere no banco
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone, senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $telefone, $senha_hash]);
        
        // Loga o usuário automaticamente após cadastro
        $_SESSION['usuario_email'] = $email;

        $conn = null;
        header('Location: menu.php');
        exit;
    }
?>