<?php
$paginaActual = basename($_SERVER['PHP_SELF']);

$paginas = [
    'index.php' => 'Inici',
    'compra.php' => 'Compra',
    'admin.php' => 'Admin',
];



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
            <!--<img src="/img/logo.png" alt="Logo de La Cantina" class="logo">-->
            <span class="nom-lloc">La Cantina</span>
        </a>
        <button id="burgerBtn" aria-label="Obrir menú" aria-expanded="false" aria-controls="menu">☰</button>
        <nav id="menu" class="menu">
            <?php foreach ($paginas as $archivo => $nombre): ?>
                <a href="<?= $archivo ?>" class="<?= $archivo === $paginaActual ? 'active' : '' ?>">
                    <?= $nombre ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </header>
    <main>