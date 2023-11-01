<?php

require($_SERVER["DOCUMENT_ROOT"] . "/../config.php");
global $yhendus; 

$id = $_GET['id'] ?? '';
$kirjeldus = $_GET['kirjeldus'] ?? '';
$korpus = isset($_GET['korpus']) ? 1 : 0;
$kuvar = isset($_GET['kuvar']) ? 1 : 0;
$pakitud = isset($_GET['pakitud']) ? 1 : 0;

$stmt = $yhendus->prepare('SELECT * from arvutitellimused WHERE pakitud = 1');
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="list-page">

    <header>
        <a href="." id="list-link">Tellimused</a> |
        <a href="tellimus_add.php" id="form-link">Lisa tellimus</a> |
        <a href="statistika.php" id="statistics-link">Tellimuste nimekiri</a>|
        <a href="pakkimisleht.php" id="packaging-link">Pakkimisleht</a>|
        <a href="" id="package-ready-link">Valmis tellimused</a>
    </header>

    <main>
        <div class="list">
            <div class="first-column">ID</div>
            <div class="second-column">Kirjeldus</div>
            <div class="third-column">Korpus</div>
            <div class="fourth-column">Kuvar</div>
            <div class="fifth-column">Pakitud</div>
        </div>

        <?php foreach($result as $row) : ?>
        <div class="kirje">
            <div class="first-column"><?= $row["id"] ?></div>
            <div class="second-column"><?= $row["kirjeldus"] ?></div>
            <div class="third-column"><?= $row["korpus"] == 1 ? 'Jah' : 'Ei' ?></div>
            <div class="fourth-column"><?= $row["kuvar"] == 1 ? 'Jah' : 'Ei' ?></div>
            <div class="fifth-column"><?= $row["pakitud"] == 1 ? 'Jah' : 'Ei' ?></div>
        </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
