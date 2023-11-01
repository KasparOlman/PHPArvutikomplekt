<?php
$isEdit = $_GET["isEdit"] ?? "";

$id = $_GET["id"] ?? "";
$kirjeldus = $_GET["kirjeldus"] ?? "";
$korpus = $_GET["korpus"] ?? "";
$kuvar = $_GET["kuvar"] ?? "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>


<header>
    <a href="." id="list-link">Tellimused</a> |
    <a href="" id="form-link">Lisa tellimus</a> |
    <a href="statistika.php" id="statistics-link">Tellimuste nimekiri</a> |
    <a href="pakkimisleht.php" id="packaging-link">Pakkimisleht</a>|
    <a href="valmis_tellimused.php" id="package-ready-link">Valmis tellimused</a>

</header>


<body id="tellimus_addpage">
    <form method="get" class="input-form" action="index.php">
        <input type="hidden" name = "id" value="<?= $id ?>">
        <div class="form-name">
            <label for="kirjeldus">Kirjeldus:</label>
            <input id="kirjeldus" name="kirjeldus" value="<?= $kirjeldus ?>" >
        </div>
        <?php if ($isEdit === "yes"): ?>
            <div class="form-name">
                <label for="korpus">Korpus:</label>
                <input id="korpus" type="checkbox" name="korpus" value="" <?php if($korpus === "1"): ?>checked<?php endif?> >
            </div>
            <div class="form-name">
                <label for="kuvar">Kuvar:</label>
                <input id="kuvar" type="checkbox" name="kuvar" value="" <?php if($kuvar === "1"): ?>checked<?php endif?> >
            </div>
        <?php endif; ?>
        <div class="submit-button">
            <input type="submit" value="Saada" name="submitButton">
            <?php if ($isEdit === "yes"): ?>
                <input name="deleteButton" id="error-block" type="submit" value="Kustuta">
            <?php endif; ?>
        </div>
            
    </form>
</body>
</html>