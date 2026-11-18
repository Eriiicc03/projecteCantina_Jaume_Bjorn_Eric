<?php session_start();
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/funcions.php';
$productes = carregarProductes();

if (isset($_POST['idProducte'])) {
    afegirAComanda($_POST['idProducte']);
    header('Location: compra.php');
    exit;
}
if (isset($_POST['buidarComanda'])) {
    buidarComanda();
    header('Location: compra.php');
    exit;
}

$total = calcularTotal($_SESSION['comanda'] ?? []);
$filtreDefecte = obtenirFiltrePerHora();
?>
<main class="pagina-compra">

    <section class="cataleg">
        <nav class="filtres">
            <!-- Crea els botons de filtres, posant per defecte actiu si compleix amb la condició marcada a la funció depenent de la hora. -->
            <button id="tot" class="<?= $filtreDefecte === 'tot' ? 'actiu' : '' ?>">Tot</button>
            <button id="esmorzar" class="<?= $filtreDefecte === 'esmorzar' ? 'actiu' : '' ?>">Esmorzar</button>
            <button id="dinar" class="<?= $filtreDefecte === 'dinar' ? 'actiu' : '' ?>">Dinar</button>
            <button id="berenar" class="<?= $filtreDefecte === 'berenar' ? 'actiu' : '' ?>">Berenar</button>
        </nav>

        <div class="productes">
        <!-- // Amaguem el producte amb la classe 'ocult' si el filtre no és 'tot' i la seva franja no coincideix amb l'hora actual -->
            <?php foreach ($productes as $producte): ?> 
                <div class="producte <?= htmlspecialchars($producte['franja']) ?> <?= ($filtreDefecte !== 'tot' && $producte['franja'] !== $filtreDefecte) ? 'ocult' : '' ?>">
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
            <span><?= number_format($total, 2, ',', '.') ?> €</span>
        </div>
        <form method="post">
            <button class="btn-confirmar" name="buidarComanda">Reiniciar Comanda</button>
        </form>
        <a href="finalitzacio.php" class="btn-confirmar">Confirmar compra</a>
    </aside>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>