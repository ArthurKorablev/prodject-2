<?php

include_once "models\Recipe.php";

use models\Recipe;

$json = [];

$arrPecipes = Recipe::load();

$numOfRecipes = count($arrPecipes);

$randon = rand(0, $numOfRecipes - 1);

foreach ($arrPecipes as $idx => $recipe) {
    if ($randon == $idx) {
        $json = $arrPecipes[$idx];
    }
}

header("Content-Type: application/json");
echo json_encode($json);
