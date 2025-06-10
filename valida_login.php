<?php
    session_start();

    if(isset($_POST['email']) AND isset($_POST['senha'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $senha = filter_var($_POST['senha'], FILTER_SANITIZE_SPECIAL_CHARS);

        if($email == "henriquericha@hotmail.com") {
            $_SESSION['usuario_email'] = $email;
            header("Location: menu.php");
            exit;
        }
        elseif($email == "lucianaricha@uol.com.br") {
            $_SESSION['usuario_email'] = $email;
            header("Location: menu.php");
            exit;
        } else {
            header('Location: login?erro=1');
        }
    } else {
        echo 'teste';
    }
?>