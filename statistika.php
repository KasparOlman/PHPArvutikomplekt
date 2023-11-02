<?php
// Lisa vajadusel andmebaasi ühendus ja konfiguratsioon
require($_SERVER["DOCUMENT_ROOT"] . "/../config.php");
global $yhendus;

// Arvuta statistika
$stmt = $yhendus->prepare('SELECT COUNT(*) AS koguarv, SUM(korpus) AS korpus_arv, SUM(kuvar) AS kuvar_arv, SUM(pakitud) AS pakitud_arv FROM arvutitellimused');
$stmt->execute();
$result = $stmt->get_result();
$statistika = $result->fetch_assoc();


require("header.php");
?>

<main>
    <h1>Statistika</h1>
    <p>Kokku tellimusi: <?php echo $statistika['koguarv']; ?></p>
    <p>Arvuteid koos korpustega: <?php echo $statistika['korpus_arv']; ?></p>
    <p>Arvuteid koos kuvariga: <?php echo $statistika['kuvar_arv']; ?></p>
    <p>Pakitud tellimusi: <?php echo $statistika['pakitud_arv']; ?></p>
</main>
</body>

</html>