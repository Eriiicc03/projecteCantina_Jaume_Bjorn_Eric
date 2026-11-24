<?php
session_start();
require_once __DIR__ . "/../includes/funcions.php";


// Tancar sessió
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
// Si no ha fet login, al login
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

// Llegim les comandes (una línia JSON per comanda)
$comandes = [];
$fitxer = __DIR__ . "/../data/comandes.txt";
if (file_exists($fitxer)) {
    foreach (file($fitxer, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linia) {
        $c = json_decode($linia, true);
        if (is_array($c)) $comandes[] = $c;
    }
}
$comandes = array_reverse($comandes); // més recent primer
include __DIR__ . "/../includes/header.php";
?>
<section class="pagina-admin">
    <div class="admin-cap">
        <h2>Tiquets de les comandes</h2>
        <a href="productes-admin.php" class="btn-sortir">Productes</a>
        <form method="post" class="form-eliminar">
            <button name="logout" class="btn-sortir">Tancar sessió</button>
        </form>
    </div>

    <?php if (empty($comandes)): ?>
        <p class="sense-comandes">No hi ha cap comanda.</p>
    <?php else: ?>
        <?php foreach ($comandes as $c): $ticket = $c["ticket"] ?? []; ?>
            <article class="tiquet">
                <p class="tiquet-data"><?= htmlspecialchars($c["data"] ?? "") ?></p>
                <p class="tiquet-client"><?= htmlspecialchars($c["nom"] ?? "") ?> ·
                    <?= htmlspecialchars($c["telefon"] ?? "") ?> ·
                    <?= htmlspecialchars($c["correu"] ?? "") ?></p>
                <?php $linies = []; // productes d'aquest tiquet 
                ?>
                <ul>
                    <?php foreach ($ticket as $id => $q): $p = cercaPerID($id);
                        if (!is_array($p)) continue;
                        for ($i = 0; $i < $q; $i++) $linies[] = $p; ?>
                        <li><?= htmlspecialchars($p["nom"]) ?> x <?= (int)$q ?></li>
                    <?php endforeach; ?>
                </ul>
                <p class="tiquet-total">Total: <?= htmlspecialchars(number_format($c["total"] ?? calcularTotal($linies), 2, ",", ".")) ?> €</p>
            </article>

        <?php endforeach; ?>

    <?php endif; ?>
</section>
<?php include __DIR__ . "/../includes/footer.php"; ?>