<?php
session_start();
require_once __DIR__ . "/../includes/funcions.php";

// Missatge de confirmació
if (isset($_GET["ok"])) {
    include __DIR__ . "/../includes/header.php";
    echo "<section class=\"pagina-finalitzacio\"><h2>Comanda enviada correctament!</h2><p class=\"sense-comandes\"><a href=\"compra.php\" class=\"btn-sortir\">Tornar</a></p></section>";
    include __DIR__ . "/../includes/footer.php";
    exit;
}

// Si no hi ha comanda, tornem a compra
if (empty($_SESSION["comanda"])) {
    header("Location: compra.php");
    exit;
}

$errors = [];
$nom = $telefon = $correu = "";

// Passem la comanda a format id => quantitat
$ticket = array_count_values(array_column($_SESSION["comanda"], "id"));

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $telefon = trim($_POST["telefon"] ?? "");
    $correu = trim($_POST["correu"] ?? "");

    // Validem les dades
    if ($nom === "") $errors[] = "El nom és obligatori.";
    if (!preg_match("/^[0-9]{9}$/", $telefon)) $errors[] = "El telèfon ha de tenir 9 xifres.";
    if (!filter_var($correu, FILTER_VALIDATE_EMAIL)) $errors[] = "El correu no és vàlid.";

    // Desem la comanda i la buidem
    if (empty($errors)) {
        if (desarComanda(["nom" => $nom, "telefon" => $telefon, "correu" => $correu, "ticket" => $ticket])) {
            buidarComanda();
            header("Location: finalitzacio.php?ok=1");
            exit;
        }
        $errors[] = "No s'ha pogut desar la comanda.";
    }
}

include __DIR__ . "/../includes/header.php";
?>
<section class="pagina-finalitzacio">
    <h2>Finalitzar comanda</h2>

    <article class="tiquet">
        <ul>
            <?php foreach ($ticket as $id => $q): $p = cercaPerID($id);
                if (!is_array($p)) continue; ?>
                <li><?= htmlspecialchars($p["nom"]) ?> x <?= (int)$q ?></li>
            <?php endforeach; ?>
        </ul>
        <p class="tiquet-total">Total: <?= number_format(calcularTotal($_SESSION["comanda"]), 2, ",", ".") ?> €</p>
    </article>

    <?php foreach ($errors as $e): ?>
        <p class="error"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>

    <form method="post" class="formulari-comanda">
        <label>Nom: <input type="text" name="nom" value="<?= htmlspecialchars($nom) ?>" required></label>
        <label>Telèfon: <input type="tel" name="telefon" value="<?= htmlspecialchars($telefon) ?>" required></label>
        <label>Correu: <input type="email" name="correu" value="<?= htmlspecialchars($correu) ?>" required></label>
        <button type="submit">Enviar comanda</button>
    </form>
</section>
<?php include __DIR__ . "/../includes/footer.php"; ?>