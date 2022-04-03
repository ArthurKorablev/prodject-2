<?php

namespace models;


class Recipe implements InterRecipe
{

    private $id;
    private $title;
    private $description;
    private $jsonFile = "recipes.json";
    const JSON = "JSON";

    function __construct($title, $description)
    {
        $this->id = time();
        $this->title = $title;
        $this->description = $description;
    }

    public function load()
    {
        $strJson = '[]';
        if (file_exists(self::JSON . "/" . $this->jsonFile)) {
            $strJson = file_get_contents(self::JSON . "/" . $this->jsonFile);
        }
        return json_decode($strJson, true);
    }

    public function create()
    {
        $arrRecipes = $this->load();

        $arrRecipes[] = ["id" => $this->id, "title" => $this->title, "description" => $this->description];

        $strJson = json_encode($arrRecipes);

        if (!file_exists(self::JSON)) {
            mkdir(self::JSON);
        }

        file_put_contents(self::JSON . "/" . $this->jsonFile, $strJson);
    }
    public function edit()
    {
    }
    public function delete()
    {
        $id = $_GET["id"];

        $arrRecipes = $this->load();

        foreach ($arrRecipes as $recipe) {
            if ($id == $recipe["id"]) {
            }
        }
    }
}
