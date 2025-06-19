<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(empty($_POST["nome"]) || empty($_POST["email"]) || empty($_POST["numero"]) || empty($_POST["senha"]) || empty($_POST["confirmaSenha"])) {
            header('Location: cadastro?erro=1');
        } else if(!empty($_POST["senha"]) && !empty($_POST["confirmaSenha"]) && $_POST["senha"] != $_POST["confirmaSenha"]) {
            header('Location: cadastro?erro=2');
        } else {
            
            header('Location: home');
        }
    }
?>