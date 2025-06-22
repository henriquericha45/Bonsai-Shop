<?php
require_once "redireciona_se_logado.php";
include "header.php";
?>

<script src="script/script.js"></script>
<script src="script/beforeUnload.js"></script>

<style>
    <?php include "style.css";
    ?>
</style>

<div class="menu-cadastro">
    <form class="form-cadastro" action="valida_cadastro" method="post">
        <h1 class="titulo-cadastro"> Cadastro </h1>
        <hr>
        <?php
        if ($_GET['erro'] == 1) {
            echo "<span class='error'> * Preencha todos os campos! </span>";
        } else if ($_GET['erro'] == 2) {
            echo "<span class='error'> * Senhas não conferem! </span>";
        } else if ($_GET['erro'] == 3) {
            echo "<span class='error'> * Email já existe! </span>";
        }
        ?>
        <label for="nome"> Nome </label>
        <input class="campo" type="text" name="nome" placeholder="Nome" required>
        <label for="email"> Email </label>
        <input class="campo" type="email" name="email" placeholder="Email" required>
        <label for="telefone"> Telefone </label>
        <input onkeydown="formatador()" id="phone-number" class="campo" type="tel" name="telefone" placeholder="Número" required>
        <label for="senha"> Senha </label>
        <input class="campo" type="password" name="senha" placeholder="Senha" required>
        <label for="confirmaSenha"> Confirmar Senha </label>
        <input class="campo" type="password" name="confirmaSenha" placeholder="Confirmar Senha" required>

        <input class="botao-cadastro" type="submit" value="Cadastrar-se">
    </form>
</div>