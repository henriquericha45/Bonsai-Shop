<script src="script/beforeUnload.js"></script>
<?php
session_start();
include "header.php";

?>

<style>
    <?php include "style.css";
    ?>
</style>

<div class="menu-cadastro">
    <form class="form-cadastro" action="valida_login" method="post">
        <h1 class="titulo-cadastro"> Login </h1>
        <hr>
        <?php
        if ($_GET['erro'] == 1) {
            echo "<span class='error'> * Preencha todos os campos! </span>";
        } else if ($_GET['erro'] == 1) {
            echo "<span class='error'> * Senhas não conferem! </span>";
        }
        ?>
        <label for="email"> Email </label>
        <input class="campo" type="text" name="email" placeholder="Email" required>
        <label for="senha"> Senha </label>
        <input class="campo" type="password" name="senha" placeholder="Senha" required>

        <input class="botao-cadastro" type="submit" value="Logar">
    </form>
</div>

<?php
echo $_SESSION['logado'];