<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;

class JsonProductRepository implements ProductRepositoryInterface
{
    private $dataFile;

    public function __construct($dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function getProductById($productId)
    {
        // Read the JSON file contents
        $json = file_get_contents($this->dataFile);

        // Decode the JSON into an array of objects
        $data = json_decode($json);

        // Search for the product by ID in the array
        foreach ($data as $product) {
            if ($product->id == $productId) {
                return $product;
            }
        }

        return null; // Product not found
    }
}