<?php session_start();
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/funcions.php';
$productes = carregarProductes();

if (isset($_POST['idProducte'])) {
    afegirAComanda($_POST['idProducte']);
}

if (isset($_POST['buidarComanda'])) {
    buidarComanda();
}

?>
<main class="pagina-compra">

    <section class="cataleg">
        <nav class="filtres">
            <button id="tot" class="actiu">Tot</button>
            <button id="esmorzar">Esmorzar</button>
            <button id="dinar">Dinar</button>
            <button id="berenar">Berenar</button>
        </nav>

        <div class="productes">
            <?php foreach ($productes as $producte): ?>
                <div class="producte <?= htmlspecialchars($producte['franja']) ?>">
                    <img src="<?= htmlspecialchars($producte['imagen']) ?>"
                        alt="<?= htmlspecialchars($producte['nom']) ?>">

                    <p class="nom"><?= htmlspecialchars($producte['nom']) ?></p>

                    <div class="peu-producte">
                        <p class="preu"><?= number_format($producte['preu'], 2, ',', '.') ?> €</p>
                        <form method="post">
                            <input hidden name="idProducte" value="<?= $producte['id'] ?>">
                            <button class="btn-afegir">+ Afegir</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <aside class="pedido">
        <h2>La teva comanda</h2>
        <ul>
            <?php foreach ($_SESSION['comanda'] ?? [] as $item): ?>
                <li>
                    <span><?= htmlspecialchars($item['nom']) ?></span>
                    <span><?= number_format($item['preu'], 2, ',', '.') ?> €</span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="total">
            <span>Total</span>
            <span>0,00 €</span>
        </div>
        <form method="post">
            <button class="btn-confirmar" name="buidarComanda">Reiniciar Comanda</button>
        </form>
        <a href="finalitzacio.php" class="btn-confirmar">Confirmar compra</a>
    </aside>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>