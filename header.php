<?php
session_start();
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <!-- <h2>Henrique Richa</h2> -->
    <img src="./images/logo_bonsai.png" class="logo"> 
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <nav>
        <ul>
            <li><a href="index">Início</a></li>
            <li><a href="#sobre">Sobre</a></li>
            <!-- <li><a href="#">Blog</a></li> -->
            <li><a href="cadastro">Cadastro</a></li>
            <li><a href="login">Login</a></li>
            <?php if (isset($_SESSION['usuario_email'])): ?>
                <li><a href="carrinho">Carrinho</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <label for="nav-toggle" class="nav-toggle-label">
        <span></span>
    </label>
    <?php if (isset($_SESSION['usuario_email'])): ?>
        <div style="position: fixed; top: 20px; right: 20px; z-index: 1000;">
            <a href="logout" style="color: red; font-weight: bold;">Logout</a>
        </div>
    <?php endif; ?>
</header>