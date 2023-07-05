<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\models\Product;

class JsonProductRepository implements ProductRepositoryInterface
{
    private $dataFile;

    public function __construct($dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function getProductById($productId): ?Product
    {
        // Read the JSON file contents
        $json = file_get_contents($this->dataFile);

        // Decode the JSON into an array of objects
        $data = json_decode($json);

        // Search for the product by ID in the array
        foreach ($data as $product) {
            if ($product->id == $productId) {
                if (!isset($product->id) ||
                    !isset($product->name) ||
                    !isset($product->salesPrice) ||
                    !isset($product->productTypeId)
                ) {
                    return null;
                }

                return new Product(
                    $product->id,
                    $product->name,
                    $product->salesPrice,
                    $product->productTypeId,
                );
            }
        }

        return null; // Product not found
    }
}