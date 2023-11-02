<?php
$isEdit = $_GET["isEdit"] ?? "";

$id = $_GET["id"] ?? "";
$kirjeldus = $_GET["kirjeldus"] ?? "";
$korpus = $_GET["korpus"] ?? "";
$kuvar = $_GET["kuvar"] ?? "";


require("header.php");
?>






<body id="tellimus_addpage">
    <form method="get" class="input-form" action="index.php">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-name">
            <label for="kirjeldus">Kirjeldus:</label>
            <input id="kirjeldus" name="kirjeldus" value="<?= $kirjeldus ?>">
        </div>
        <?php if ($isEdit === "yes") : ?>
            <div class="form-name">
                <label for="korpus">Korpus:</label>
                <input id="korpus" type="checkbox" name="korpus" value="" <?php if ($korpus === "1") : ?>checked<?php endif ?>>
            </div>
            <div class="form-name">
                <label for="kuvar">Kuvar:</label>
                <input id="kuvar" type="checkbox" name="kuvar" value="" <?php if ($kuvar === "1") : ?>checked<?php endif ?>>
            </div>
        <?php endif; ?>
        <div class="submit-button">
            <input type="submit" value="Saada" name="submitButton">
            <?php if ($isEdit === "yes") : ?>
                <input name="deleteButton" id="error-block" type="submit" value="Kustuta">
            <?php endif; ?>
        </div>

    </form>
</body>

</html>