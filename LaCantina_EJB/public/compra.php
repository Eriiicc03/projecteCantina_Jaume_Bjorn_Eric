<?php
session_start();
require_once __DIR__ . '/../includes/funcions.php';

// Comprovem l'estat de la botiga abans de processar qualsevol acció
$filtreDefecte = obtenirFiltrePerHora();
$estaTancat = ($filtreDefecte === 'tancat');

// Només permetem afegir productes si la cantina està oberta (de 08:00 a 19:59)
if (isset($_POST['idProducte']) && !$estaTancat) {
    afegirAComanda($_POST['idProducte']);
    header('Location: compra.php');
    exit;
}

if (isset($_POST['buidarComanda'])) {
    buidarComanda();
    header('Location: compra.php');
    exit;
}

// Eliminar producte de la llista del carrito
if (isset($_POST['eliminarProducte'])) {
    treureDeComanda($_POST['eliminarProducte']);
    header('Location: compra.php');
    exit;
}


$productes = carregarProductes();
$total = calcularTotal($_SESSION['comanda'] ?? []);

include __DIR__ . '/../includes/header.php';
?>
<main class="pagina-compra">

    <?php if ($estaTancat): ?>
        <!-- Avís de tancament fora d'horari (20:00 - 07:59) -->
        <section class="cantina-tancada">
            <h2>La Cantina està tancada</h2>
            <p>El nostre horari de comandes és de <strong>08:00 a 20:00</strong>.</p>
            <p>Torna demà a partir de les 8:00 per fer la teva comanda!</p>
            <a href="index.php" class="btn-confirmar">Tornar a l'inici</a>
        </section>
    <?php else: ?>
        <!-- Catàleg i comanda actius durant l'horari d'obertura -->
        <section class="cataleg">
            <nav class="filtres">
                <button id="tot" class="<?= $filtreDefecte === 'tot' ? 'actiu' : '' ?>">Tot</button>
                <button id="esmorzar" class="<?= $filtreDefecte === 'esmorzar' ? 'actiu' : '' ?>">Esmorzar</button>
                <button id="dinar" class="<?= $filtreDefecte === 'dinar' ? 'actiu' : '' ?>">Dinar</button>
                <button id="berenar" class="<?= $filtreDefecte === 'berenar' ? 'actiu' : '' ?>">Berenar</button>
            </nav>

            <div class="productes">
                <?php foreach ($productes as $producte): ?>
                    <?php
                    // Amaguem el producte només si no estem a 'tot', el producte no és de 'tot' i no coincideix amb la franja actual
                    $esAltreHorari = ($filtreDefecte !== 'tot' && $producte['franja'] !== 'tot' && $producte['franja'] !== $filtreDefecte);
                    $classeOcult = $esAltreHorari ? 'ocult' : '';
                    ?>
                    <div class="producte <?= htmlspecialchars($producte['franja']) ?> <?= $classeOcult ?>">
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
                <?php foreach ($_SESSION['comanda'] ?? [] as $index => $item): ?>
                    <li>
                        <span><?= htmlspecialchars($item['nom']) ?></span>
                        <span><?= number_format($item['preu'], 2, ',', '.') ?> €</span>
                        <form method="post">
                            <input type="hidden" name="eliminarProducte" value="<?= $index ?>">
                            <button class="borrar" aria-label="Eliminar">X</button>
                        </form>
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
    <?php endif; ?>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>