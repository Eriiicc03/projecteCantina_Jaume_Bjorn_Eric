<?php
$paginaActual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cantina</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" type="image/png" href="/assets/img/logo.png">
</head>

<body>
    <header>
        <a href="/index.php" class="marca">
            <img src="/assets/img/logo.png" alt="Logo de La Cantina" class="logo">
            <span class="nom-lloc">La Cantina</span>
        </a>
        <nav>
            <ul class="menu">
                <li><a href="/compra.php" class="<?= $paginaActual === 'compra.php' ? 'actiu' : '' ?>">Compra</a></li>
                <li><a href="/admin.php" class="<?= $paginaActual === 'admin.php' ? 'actiu' : '' ?>">Administració</a></li>
            </ul>
        </nav>
    </header>
    <main>