<?php
require_once 'inc/maininclude.inc.php';
include ('inc/header-loggedin.inc.php');

if(isset($_POST['btlogout'])){
    $paedagogeManager->logout();
    header('Location: ./');
}
?>

<!-- Inhalt der Seite -->
<main class="center-wrapper">
    <h1>Logout</h1>
    <form action="logout.php" method="POST">
        <button name="btlogout">Abmelden</button>
    </form>
</main>

<?php
include('./inc/footer.inc.php');
?>