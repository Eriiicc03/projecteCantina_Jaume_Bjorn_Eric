<?php
// Carreguem les funcions per poder llegir els productes i calcular el preu d'oferta
require_once __DIR__ . '/../includes/funcions.php';
require __DIR__ . '/../includes/header.php';

$ofertes = array_filter(carregarProductes(), fn($p) => $p['oferta']);
?>

<main>
    <section class="portada_index">
        <a href="compra.php" class="btn-comanda">Fer una comanda</a>
    </section>

    <section class="ofertes-dia">
        <h2>Ofertes del dia</h2>

        <?php if (empty($ofertes)): ?>
            <!-- Si cap producte està en oferta, mostrem un missatge -->
            <p>Avui no hi ha ofertes disponibles. Torna demà!</p>
        <?php else: ?>
            <div class="ofertes-llista">
                <!-- Una targeta per cada producte en oferta -->
                <?php foreach ($ofertes as $oferta): ?>
                    <div class="oferta">
                        <span class="etiqueta">Oferta</span>
                        <img src="<?= $oferta['imagen'] ?>" alt="<?= $oferta['nom'] ?>">
                        <h3><?= $oferta['nom'] ?></h3>
                        <p><?= $oferta['descripcio'] ?></p>
                        <!-- Preu: si hi ha descompte, mostrem el preu normal tatxat i al costat el preu d'oferta -->
                        <p class="preu">
                            <?php if (preuFinal($oferta) < $oferta['preu']): ?>
                                <s><?= number_format($oferta['preu'], 2, ',', '.') ?> €</s>
                            <?php endif; ?>
                            <?= number_format(preuFinal($oferta), 2, ',', '.') ?> €
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
