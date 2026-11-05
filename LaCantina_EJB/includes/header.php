<?php
$paginaActual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina</title>
    <link rel="icon" type="image/png" href="/img/logo.png">
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/src/assets/js/main.js"></script>
</head>

<body>
    <header>
        <a href="/index.php" class="marca">
<<<<<<< HEAD
            <!--<img src="/img/logo.png" alt="Logo de La Cantina" class="logo">-->
=======
           <!-- <img src="/img/logo.png" alt="Logo de La Cantina" class="logo"> -->
>>>>>>> 7c13fd9b529792e1df54330476e5f97fd852e8f7
            <span class="nom-lloc">La Cantina</span>
        </a>
        <button id="burgerBtn">☰</button>
        <nav>
            <ul class="menu">
                <li><a href="/compra.php" class="<?= $paginaActual === 'compra.php' ? 'actiu' : '' ?>">Compra</a></li>
                <li><a href="/admin.php" class="<?= $paginaActual === 'admin.php' ? 'actiu' : '' ?>">Administració</a></li>
            </ul>
        </nav>
    </header>
    <main>