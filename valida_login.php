<?php
    session_start();

    if (isset($_POST['email']) && isset($_POST['senha'])) {

        // dados brutos
        $email = trim($_POST['email']);
        $senha = $_POST['senha'];

        // conexão segura
        require_once "conexao.php";
        $conn = (new Conexao())->conectar();

        // busca usuário pelo e‑mail
        $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($email) || empty($senha)) {
            header('Location: login?erro=1');
            exit;
        }

        if (!$usuario) {
            header('Location: login?erro=2');
            exit;
        }

        if (!password_verify($senha, $usuario['senha'])) {
            header('Location: login?erro=3');
            exit;
        }

        session_regenerate_id(true);           // previne fixation
        $_SESSION['usuario_email'] = $email;   // marca login
        header("Location: menu.php");
        exit;
    } else {
        header('Location: login?erro=1');
        exit;
    }
?>