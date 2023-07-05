<?php

namespace App\models;

class Product
{
    private int $id;
    private string $name;
    private int $salesPrice;
    private int $productTypeId;

    public function __construct(int $id, string $name, int $salesPrice, int $productTypeId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->salesPrice = $salesPrice;
        $this->productTypeId = $productTypeId;
    }

    public function __toString()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'salesPrice' => $this->salesPrice,
            'productTypeId' => $this->productTypeId
        ]);
    }
}