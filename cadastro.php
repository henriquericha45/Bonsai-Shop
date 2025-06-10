<script src="script/script.js"></script>
<script src="script/beforeUnload.js"></script>
<?php
include "header.php";
?>

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
        }
        ?>
        <label for="nome"> Nome </label>
        <input class="campo" type="text" name="nome" placeholder="Nome" required>
        <label for="email"> Email </label>
        <input class="campo" type="email" name="email" placeholder="Email" required>
        <label for="numero"> Telefone </label>
        <input onkeydown="formatador()" id="phone-number" class="campo" type="tel" name="numero" placeholder="Número" required>
        <label for="senha"> Senha </label>
        <input class="campo" type="password" name="senha" placeholder="Senha" required>
        <label for="confirmaSenha"> Confirmar Senha </label>
        <input class="campo" type="password" name="confirmaSenha" placeholder="Confirmar Senha" required>

        <input class="botao-cadastro" type="submit" value="Cadastrar-se">
    </form>
</div>