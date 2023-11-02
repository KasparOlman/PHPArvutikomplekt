<?php

require($_SERVER["DOCUMENT_ROOT"] . "/../config.php");
global $yhendus;

$id = $_GET['id'] ?? 0;
$pakkiminesubmit = $_GET['pakkimisButton'] ?? '';

if ($pakkiminesubmit) {
    $stmt_submit = $yhendus->prepare("UPDATE arvutitellimused SET pakitud = 1 WHERE id = (?) ");
    $stmt_submit->bind_param("i", $id);
    $stmt_submit->execute();
}
$stmt = $yhendus->prepare('SELECT * FROM arvutitellimused WHERE korpus = 1 AND kuvar = 1 AND pakitud = 0');
$stmt->execute();
$result = $stmt->get_result();


require("header.php");
?>

<main>

    <div class="list">
        <div class="first-column">ID</div>
        <div class="second-column">Kirjeldus</div>
        <div class="fifth-column">Pakitud</div>
    </div>


    <?php foreach ($result as $row) : ?>
        <div class="kirje">
            <div class="first-column"><?= $row["id"] ?></div>
            <div class="second-column"><?= $row["kirjeldus"] ?></div>
            <div class="fifth-column">
                <form method="get" action="">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <div class="tellimused-button">
                        <input type="submit" value="Kinnita Pakkimine" name="pakkimisButton">
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

</main>
</body>

</html>