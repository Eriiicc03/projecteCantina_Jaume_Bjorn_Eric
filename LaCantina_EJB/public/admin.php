<?php
session_start();

if (!isset($_SESSION['admin'])) {   // si no ha hecho login...
    header('Location: login.php');  // ...lo mandamos al login
    exit;
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<main>
    ADMINISTRACION

</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>