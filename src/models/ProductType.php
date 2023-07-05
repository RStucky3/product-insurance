<?php

namespace App\models;

class ProductType
{
    private int $id;
    private string $name;
    private bool $canBeInsured;

    public function __construct(int $id, string $name, bool $canBeInsured)
    {
        $this->id = $id;
        $this->name = $name;
        $this->canBeInsured = $canBeInsured;
    }

    public function __toString()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'canBeInsured' => $this->canBeInsured
        ]);
    }
}