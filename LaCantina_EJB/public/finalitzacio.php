<?php
session_start();
require_once __DIR__ . "/../includes/funcions.php";

// Missatge de confirmació
// Missatge de confirmació + tiquet
if (isset($_GET["ok"]) && !empty($_SESSION["ultimTiquet"])) {
    $ticket = $_SESSION["ultimTiquet"];
    include __DIR__ . "/../includes/header.php";
?>
    <section class="pagina-finalitzacio">
        <h2>Comanda enviada correctament!</h2>

        <article class="tiquet">
            <p class="tiquet-data"><?= htmlspecialchars($ticket["data"]) ?></p>
            <p class="tiquet-client"><?= htmlspecialchars($ticket["nom"]) ?> ·
                <?= htmlspecialchars($ticket["telefon"]) ?> ·
                <?= htmlspecialchars($ticket["correu"]) ?></p>
            <ul>
                <?php foreach ($ticket["ticket"] as $id => $quantitat): $producte = cercaPerID($id);
                    if (!is_array($producte)) continue; ?>
                    <li>
                        <?= htmlspecialchars($producte["nom"]) ?> x <?= (int)$quantitat ?>
                        — <?= number_format($producte["preu"] * $quantitat, 2) ?> €
                    </li>
                <?php endforeach; ?>
            </ul>
            <p class="tiquet-total">Total: <?= number_format($ticket["total"], 2) ?> €</p>
        </article>

        <p class="sense-comandes">
            <a href="compra.php" class="btn-sortir">Tornar</a>
        </p>
    </section>
<?php
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
        $dades = [
            "nom" => $nom,
            "telefon" => $telefon,
            "correu" => $correu,
            "ticket" => $ticket,
            "total" => calcularTotal($_SESSION["comanda"])
        ];
        if (desarComanda($dades)) {
            // Guardem una còpia per mostrar-la després de la redirecció
            $_SESSION["ultimTiquet"] = $dades + ["data" => date("d/m/Y H:i")];
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
            <?php foreach ($ticket as $id => $quantitat): $producte = cercaPerID($id);
                if (!is_array($producte)) continue; ?>
                <li><?= htmlspecialchars($producte["nom"]) ?> x <?= (int)$quantitat ?></li>
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