<?php

namespace models;

interface InterRecipe
{
    public function create();
    public function edit($id, $title, $description);
    public function delete($id);
}
