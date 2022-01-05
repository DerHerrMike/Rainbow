<?php
require_once 'inc/maininclude.inc.php';

$kindManager = new KindManager($connection);

$showFormular = true; // die Registrierung soll angezeigt werden

$errors = [];

if (isset($_POST['btregister'])) {

    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $geschlecht = $_POST['geschlecht'];
    $geburtsdatum = $_POST['geburtsdatum'];
    $eintrittsdatum = $_POST['eintrittsdatum'];
    $geschwister = $_POST['geschwister'];
    $fk_erziehungsberechtigte_id = $_POST['fk_erziehungsberechtigte_id'];
    $fk_paedagoge_id = $_POST['fk_paedagoge_id'];

    $geborenam = DateTime::createFromFormat('d.m.Y', $geburtsdatum);
    if($geborenam === false){
        $errors[] = "Geburtsdatum ist ungültig->$geburtsdatum";
    }
    $eingetrettenam = DateTime::createFromFormat('d.m.Y', $eintrittsdatum);
    if($eingetrettenam === false){
        $errors[] = "Eintrittsdatum ist ungültiug->$eintrittsdatum";
    }

    $istmaennlich = false;
    if ($geschlecht == 'm'){
        $istmaennlich = true;
    }

    if (strlen($vorname) == 0) {
        $errors[] = 'Bitte ein Vornamen angeben!';
    }
    if (strlen($nachname) == 0) {
        $errors[] = 'Bitte ein Nachname angeben';
    }

    if (count($errors) == 0) {
        $id = 1;
        if ($kindManager->getKindById($id) != false) {
            $errors[] = 'Das Kind wurde bereits registriert!';
        } else {
            $id = $kindManager->registerKind($vorname, $nachname, $istmaennlich, $geborenam, $eingetrettenam,
                $geschwister, $fk_erziehungsberechtigte_id, $fk_paedagoge_id);
            header('Location: ./index.php');
            echo "<h1>Das Kind wurde erfolgreich angelegt!!</h1>";
            return;
        }
    }

}

if ($showFormular) {
?>
<head xmlns="http://www.w3.org/1999/html">
    <meta charset="utf-8"/>
    <title>Kompetenz Regenbogen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<?php include 'inc/header.inc.php'; ?>
<form action="?register=1" method="post">
    <section>
        <h2>Kind Registrierung</h2>
    <form action="." method="POST">
        <?php include 'inc/errormessages.inc.php'; ?>

        <label for="vorname">Vorname:</label>
        <input type="text" id="vorname" name="vorname" required><br><br>
        <label for="nachname">Nachname:</label>
        <input type="text" id="nachname" name="nachname" required><br><br>
        <label for="geschlecht">M:</label>
        <input type="radio" id="geschlecht" name="geschlecht" value="m"><br><br>
        <label for="geschlecht">F:</label>
        <input type="radio" id="geschlecht" name="geschlecht" value="w"><br><br>
        <label for="geburtsdatum">Geburtsdatum(tt.mm.jjjj):</label>
        <input type="text" id="geburtsdatum" name="geburtsdatum" required><br><br>
        <label for="eintrittsdatum">Eintrittsdatum(tt.mm.jjjj):</label>
        <input type="text" id="eintrittsdatum" name="eintrittsdatum" required><br><br>
        <label for="geschwister">Anzahl der Geschwister:</label>
        <input type="integer" id="geschwister" name="geschwister" required><br><br>
        <label for="fk_paedagoge_id">ID des Mitarbeiters:</label>
        <input type="integer" id="fk_paedagoge_id" name="fk_paedagoge_id" required><br><br>
        <label for="fk_erziehungsberechtigte_id">ID des Erzihungsberechtigten:</label>
        <input type="integer" id="fk_erziehungsberechtigte_id" name="fk_erziehungsberechtigte_id" required><br><br>
        <button name="btregister">Kind registrieren!</button>
    </form>
</section>
<?php
} //Ende von if($showFormular)
include('./inc/footer.inc.php');
?>
</body>
