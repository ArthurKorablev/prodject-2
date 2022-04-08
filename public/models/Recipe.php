<?php

namespace models;


class Recipe
{

    private $id;
    private $title;
    private $description;
    const JSFILE = "recipes.json";
    const JSON = "JSON";

    function __construct($title, $description)
    {
        $this->id = time();
        $this->title = $title;
        $this->description = $description;
    }

    static function load()
    {
        $strJson = '[]';
        if (file_exists(self::JSON . "/" . self::JSFILE)) {
            $strJson = file_get_contents(self::JSON . "/" . self::JSFILE);
        }
        return json_decode($strJson, true);
    }

    public function create()
    {
        $arrRecipes = self::load();

        $arrRecipes[] = ["id" => $this->id, "title" => $this->title, "description" => $this->description];

        $strJson = json_encode($arrRecipes);

        if (!file_exists(self::JSON)) {
            mkdir(self::JSON);
        }

        file_put_contents(self::JSON . "/" . self::JSFILE, $strJson);
    }


    static function edit($id, $title, $description)
    {
        $arrRecipes = self::load();

        foreach ($arrRecipes as &$recipe) {
            if ($recipe["id"] == $id) {
                $recipe["title"] = $title;
                $recipe["description"] = $description;
            }
        }
        $strJson = json_encode($arrRecipes);

        if (!file_exists(self::JSON)) {
            mkdir(self::JSON);
        }

        file_put_contents(self::JSON . "/" . self::JSFILE, $strJson);
    }


    static function delete($id)
    {
        $arrRecipes = self::load();
        $deleteIdx = -1;

        foreach ($arrRecipes as $idx => $recipe) {
            if ($recipe["id"] == $id) {
                $deleteIdx = $idx;
                break;
            }
        }

        if ($deleteIdx != -1) {
            array_splice($arrRecipes, $idx, 1);
        }
        $strJson = json_encode($arrRecipes);

        if (!file_exists(self::JSON)) {
            mkdir(self::JSON);
        }

        file_put_contents(self::JSON . "/" . self::JSFILE, $strJson);
    }
}
