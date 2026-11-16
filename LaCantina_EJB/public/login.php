<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $usuaris = require __DIR__ . '/usuaris.php';

    $usuari = $_POST['usuario'] ?? '';
    $contrasenya = $_POST['password'] ?? '';

    /*Comprovem si l'usuari es correcta dins de la llista que tenim d'usario al arxiu usuaris.php */
    foreach ($usuaris as $u) {

        if ($u['usuario'] === $usuari && $u['password'] === $contrasenya) {
            $_SESSION['admin'] = $usuari; //guardamos que ha entrado

            header('Location: admin.php');  //redirigim a admin.php
        }
    }
}

?>

<?php include __DIR__ . '/../includes/header.php'; ?>
<main>
    <h2 id="titol-login">LOGIN ADMINISTRACIO</h2>

    <form method="POST" action="login.php" class="formulari-admin">
        <label>Usuari: </label>
        <input type="text" name="usuario" required>
        <br>
        <label>Contrasenya: </label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Entrar</button>
    </form>

</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>