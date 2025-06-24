<?php
require_once "redireciona_se_logado.php";
include "header.php";
?>

<script src="script/beforeUnload.js"></script>

<style>
    <?php include "style.css";?>
</style>

<div class="menu-cadastro">
    <form class="form-cadastro" action="valida_login" method="post">
        <h1 class="titulo-cadastro"> Login </h1>
        <hr>
        <?php
            if (isset($_GET['erro'])) {
                if ($_GET['erro'] == 1) {
                    echo "<span class='error'> * Preencha todos os campos! </span>";
                } else if ($_GET['erro'] == 2) {
                    echo "<span class='error'> * Email não existe! </span>";
                } else if ($_GET['erro'] == 3) {
                    echo "<span class='error'> * Senha errada! </span>";
                }
            }
        ?>
        <label for="email"> Email </label>
        <input class="campo" type="email" name="email" placeholder="Email" required>
        <label for="senha"> Senha </label>
        <input class="campo" type="password" name="senha" placeholder="Senha" required autocomplete="off">

        <input class="botao-cadastro" type="submit" value="Logar">
    </form>
</div>

<?php
echo $_SESSION['logado'];