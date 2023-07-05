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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSalesPrice(): int
    {
        return $this->salesPrice;
    }

    public function getProductTypeId(): int
    {
        return $this->productTypeId;
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