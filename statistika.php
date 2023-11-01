<?php
// Lisa vajadusel andmebaasi ühendus ja konfiguratsioon
require($_SERVER["DOCUMENT_ROOT"] . "/../config.php");
global $yhendus; 

// Arvuta statistika
$stmt = $yhendus->prepare('SELECT COUNT(*) AS koguarv, SUM(korpus) AS korpus_arv, SUM(kuvar) AS kuvar_arv, SUM(pakitud) AS pakitud_arv FROM arvutitellimused');
$stmt->execute();
$result = $stmt->get_result();
$statistika = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistikaleht</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body id="stats-page">

    <header>
        <a href="." id="list-link">Tellimused</a> |
        <a href="tellimus_add.php" id="form-link">Lisa tellimus</a> |
        <a href="" id="statistics-link">Tellimuste nimekiri</a> |
        <a href="pakkimisleht.php" id="packaging-link">Pakkimisleht</a> |
        <a href="valmis_tellimused.php" id="package-ready-link">Valmis tellimused</a>
    </header>

    <main>
        <h1>Statistika</h1>
        <p>Kokku tellimusi: <?php echo $statistika['koguarv']; ?></p>
        <p>Arvuteid koos korpustega: <?php echo $statistika['korpus_arv']; ?></p>
        <p>Arvuteid koos kuvariga: <?php echo $statistika['kuvar_arv']; ?></p>
        <p>Pakitud tellimusi: <?php echo $statistika['pakitud_arv']; ?></p>
    </main>
</body>
</html>
