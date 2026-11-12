<?php include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/funcions.php';
$productes = carregarProductes();
?>
<main class="pagina-compra">

    <section class="cataleg">
        <nav class="filtres">
            <button id="tot" class="actiu">Tot</button>
            <button id="entrepans">Entrepans</button>
            <button id="begudes">Begudes</button>
            <button id="dolcos">Dolços</button>
        </nav>

        <div class="productes">
            <?php foreach ($productes as $producte): ?>
                <div class="producte">
                    <img src="<?= htmlspecialchars($producte['imagen']) ?>"
                        alt="<?= htmlspecialchars($producte['nom']) ?>">

                    <p class="nom"><?= htmlspecialchars($producte['nom']) ?></p>

                    <div class="peu-producte">
                        <p class="preu"><?= number_format($producte['preu'], 2, ',', '.') ?> €</p>
                        <button class="btn-afegir">+ Afegir</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <aside class="pedido">
        <h2>La teva comanda</h2>
        <ul>
            <li><span>Producte A x1</span><span>0,00 €</span></li>
            <li><span>Producte B x2</span><span>0,00 €</span></li>
        </ul>
        <div class="total">
            <span>Total</span>
            <span>0,00 €</span>
        </div>
        <button class="btn-confirmar">Confirmar compra</button>
    </aside>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>