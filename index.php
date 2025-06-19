    <?php
        session_start();
        # <!-- HEADER -->
        include "header.php"; 
        # <!-- FIM HEADER -->
    ?>
    <style>
        <?php 
            include "style.css";
        ?>
    </style>

    <img id="inicio" class="imagem-bonsai" src="./images/capa-bonsai-menor.jpg">

    <!-- CARRINHO -->
    <?php
        include "produtos.php";
    ?>
    <!-- FIM CARRINHO -->

    <!-- SOBRE -->
    <div id="sobre" class="sobre"></div>
    <!-- FIM SOBRE -->