<?php

use models\Recipe;

spl_autoload_register(function ($className) {
    $file = "$className.php";
    if (file_exists($file)) {
        include_once "$className.php";
    }
});

$id = $_GET["id"] ?? 0;
$method = $_GET["method"] ?? "";

$recipes = Recipe::load();
$recipeForm = [];
if ($id != 0) {
    foreach ($recipes as $recipe) {
        if ($recipe["id"] == $id) {
            $recipeForm = $recipe;
        }
    }
}

if ($method == "delete" && $id != 0) {
    Recipe::delete($id);
    header("location: form.php");
}

if (count($_POST) > 0) {
    if ($id == 0) {
        $newRecipe = new Recipe($_POST["title"], $_POST["description"]);
        $newRecipe->create();
        header("location: form.php");
    } else {
        Recipe::edit($id, $_POST["title"], $_POST["description"]);
        header("location: form.php");
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <?php
    foreach ($recipes as $recipe) { ?>

        <div style="width: 120px; border: 1px solid black; text-align: center; margin-bottom: 20px; padding: 5px">
            <h3><?= $recipe["title"] ?></h3>
            <p><?= $recipe["description"] ?></p>
            <a href="?id=<?= $recipe["id"] ?>">edit</a>
            <a href="?id=<?= $recipe["id"] ?>&method=delete">delete</a>
        </div>

    <?php } ?>


    <div class="container" style="margin-top: 1em;">
        <form class="form-dark" method="post">
            <input type="hidden" value="<?= $recipeForm["id"] ?? "" ?>" name="id" />
            <input name="title" value="<?= $recipeForm["title"] ?? "" ?>" placeholder="Title"><br />
            <textarea name="description"><?= $recipeForm["description"] ?? "" ?></textarea><br />
            <button type="submit">Create/Edit</button>
        </form>
    </div>

</body>

</html>