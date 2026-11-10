<?php include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/funcions.php';
$productes = carregarProductes();
?>
<main>
    <h1>PRODUCTES</h1>

    <?php foreach ($productes as $producte): ?>
        <div class="producte">
            <img src="<?= htmlspecialchars($producte['imagen']) ?>"
                alt="<?= htmlspecialchars($producte['nom']) ?>">

            <p><?= htmlspecialchars($producte['nom']) ?></p>
            <p><?= htmlspecialchars($producte['preu']) ?> €</p>

            <button class="btn-afegir">+ Afegir</button>
        </div>
    <?php endforeach; ?>

</main>


<?php include __DIR__ . '/../includes/footer.php'; ?>