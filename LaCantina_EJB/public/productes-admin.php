<?php
session_start();
require_once __DIR__ . "/../includes/funcions.php";

// Si no ha fet login, al login
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

$fitxer = __DIR__ . "/../data/productes.json";
$productes = carregarProductes();
$franges = ["esmorzar", "dinar", "berenar"];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $accio = $_POST["accio"] ?? "";
    $id = (int)($_POST["id"] ?? 0);

    // Eliminar producte
    if ($accio === "eliminar") {
        $productes = array_values(array_filter($productes, fn($p) => $p["id"] != $id));
    }

    // Afegir o modificar producte
    if ($accio === "desar") {
        $dades = [
            "nom" => trim($_POST["nom"] ?? ""),
            "descripcio" => trim($_POST["descripcio"] ?? ""),
            "preu" => (float)str_replace(",", ".", $_POST["preu"] ?? "0"),
            "categoria" => trim($_POST["categoria"] ?? ""),
            "franja" => $_POST["franja"] ?? "",
            "imagen" => trim($_POST["imagen"] ?? ""),
            "oferta" => isset($_POST["oferta"]),
        ];

        // Validem les dades
        if ($dades["nom"] === "") $errors[] = "El nom és obligatori.";
        if ($dades["preu"] <= 0) $errors[] = "El preu ha de ser més gran que 0.";
        if (!in_array($dades["franja"], $franges)) $errors[] = "La franja no és vàlida.";

        if (empty($errors)) {
            if ($id > 0) {
                // Modifiquem el que ja existeix
                foreach ($productes as $i => $p) {
                    if ($p["id"] == $id) $productes[$i] = ["id" => $id] + $dades;
                }
            } else {
                // Nou id = el més alt + 1
                $nouId = empty($productes) ? 1 : max(array_column($productes, "id")) + 1;
                $productes[] = ["id" => $nouId] + $dades;
            }
        }
    }

    // Desem el JSON i tornem a la pàgina
    if (empty($errors)) {
        file_put_contents($fitxer, json_encode($productes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), LOCK_EX);
        header("Location: productes-admin.php");
        exit;
    }
}

// Producte a editar (si n'hi ha)
$editar = null;
if (isset($_GET["editar"])) {
    foreach ($productes as $p) {
        if ($p["id"] == (int)$_GET["editar"]) $editar = $p;
    }
}

include __DIR__ . "/../includes/header.php";
?>
<section class="pagina-admin">
    <div class="admin-cap">
        <h2>Gestió de productes</h2>
        <a href="admin.php" class="btn-sortir">Tiquets</a>
    </div>

    <?php foreach ($errors as $e): ?>
        <p class="error"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>

    <!-- Formulari afegir / modificar -->
    <form method="post" class="formulari-comanda tiquet">
        <h3><?= $editar ? "Modificar producte" : "Afegir producte" ?></h3>
        <input type="hidden" name="accio" value="desar">
        <input type="hidden" name="id" value="<?= (int)($editar["id"] ?? 0) ?>">
        <label>Nom <input type="text" name="nom" value="<?= htmlspecialchars($editar["nom"] ?? "") ?>" required></label>
        <label>Descripció <input type="text" name="descripcio" value="<?= htmlspecialchars($editar["descripcio"] ?? "") ?>"></label>
        <label>Preu (€) <input type="number" step="0.01" min="0.01" name="preu" value="<?= htmlspecialchars($editar["preu"] ?? "") ?>" required></label>
        <label>Categoria <input type="text" name="categoria" value="<?= htmlspecialchars($editar["categoria"] ?? "") ?>"></label>
        <label>Franja
            <select name="franja">
                <?php foreach ($franges as $f): ?>
                    <option value="<?= $f ?>" <?= ($editar["franja"] ?? "") === $f ? "selected" : "" ?>><?= ucfirst($f) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Imatge (ruta) <input type="text" name="imagen" placeholder="img/productesIMG/..." value="<?= htmlspecialchars($editar["imagen"] ?? "") ?>"></label>
        <label><input type="checkbox" name="oferta" <?= !empty($editar["oferta"]) ? "checked" : "" ?>> En oferta</label>
        <button type="submit"><?= $editar ? "Desar canvis" : "Afegir" ?></button>
        <?php if ($editar): ?><a href="productes-admin.php" class="btn-sortir">Cancel·lar</a><?php endif; ?>
    </form>

    <!-- Llistat de productes -->
    <?php foreach ($productes as $p): ?>
        <article class="tiquet">
            <p class="tiquet-client"><?= htmlspecialchars($p["nom"]) ?> · <?= number_format($p["preu"], 2, ",", ".") ?> €</p>
            <p class="tiquet-data"><?= htmlspecialchars($p["categoria"]) ?> · <?= htmlspecialchars($p["franja"]) ?></p>
            <a href="productes-admin.php?editar=<?= (int)$p["id"] ?>" class="btn-sortir">Modificar</a>
            <form method="post" class="form-eliminar" onsubmit="return confirm('Segur que vols eliminar-lo?')">
                <input type="hidden" name="accio" value="eliminar">
                <input type="hidden" name="id" value="<?= (int)$p["id"] ?>">
                <button class="btn-sortir">Eliminar</button>
            </form>
        </article>
    <?php endforeach; ?>
</section>
<?php include __DIR__ . "/../includes/footer.php"; ?>
