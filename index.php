<?php

require($_SERVER["DOCUMENT_ROOT"] . "/../config.php");
global $yhendus; 

$id = $_GET['id'] ?? '';
$kirjeldus = $_GET['kirjeldus'] ?? '';
$korpus = isset($_GET['korpus']) ? 1 : 0;
$kuvar = isset($_GET['kuvar']) ? 1 : 0;


$submit = $_GET['submitButton'] ?? '';
$delete = $_GET['deleteButton'] ?? '';

if($delete){
    $stmt_delete = $yhendus->prepare("DELETE FROM arvutitellimused WHERE id= ?");
    $stmt_delete->bind_param("i",$id); 
    $stmt_delete->execute();
}elseif($id !== ""){
    $stmt_edit = $yhendus->prepare("UPDATE arvutitellimused SET kirjeldus = ?, korpus = ?, kuvar = ?, pakitud = 0 WHERE id = ? ");
    $stmt_edit->bind_param("siii", $kirjeldus, $korpus, $kuvar, $id); 
    $stmt_edit->execute();
}elseif ($submit){
    $stmt_submit = $yhendus->prepare("INSERT INTO arvutitellimused (kirjeldus, korpus, kuvar, pakitud) VALUES (?, ?, ?, 0)");
    $stmt_submit->bind_param("sii", $kirjeldus, $korpus, $kuvar); 
    $stmt_submit->execute();
}

$stmt = $yhendus->prepare('SELECT * from arvutitellimused WHERE !(korpus = 1 AND kuvar = 1 AND pakitud = 1)');
$stmt->execute();
$result = $stmt->get_result();

function tellimusEditForm($row) : string  {
    $id=$row["id"];
    $kirjeldus=urlencode($row["kirjeldus"]);
    $korpus=$row["korpus"];
    $kuvar=$row["kuvar"];
    $pakitud=$row["pakitud"];
    return "tellimus_add.php?id=$id&kirjeldus=$kirjeldus&korpus=$korpus&kuvar=$kuvar&pakitud=$pakitud&isEdit=yes";
}
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
        <a href="" id="list-link">Tellimused</a> |
        <a href="tellimus_add.php" id="form-link">Lisa tellimus</a> |
        <a href="statistika.php" id="statistics-link">Tellimuste nimekiri</a>|
        <a href="pakkimisleht.php" id="packaging-link">Pakkimisleht</a> |
        <a href="valmis_tellimused.php" id="package-ready-link">Valmis tellimused</a>
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
            <div class="second-column"><a href=<?=tellimusEditForm($row)?>><?= $row["kirjeldus"] ?></a></div>
            <div class="third-column"><?= $row["korpus"] == 1 ? 'Jah' : 'Ei' ?></div>
            <div class="fourth-column"><?= $row["kuvar"] == 1 ? 'Jah' : 'Ei' ?></div>
            <div class="fifth-column"><?= $row["pakitud"] == 1 ? 'Jah' : 'Ei' ?></div>
        </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
