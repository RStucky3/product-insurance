<?php

namespace App\Repositories;

use App\interfaces\ProductTypeRepositoryInterface;
use App\models\ProductType;

class JsonProductTypeRepository implements ProductTypeRepositoryInterface
{
    private $dataFile;

    public function __construct($dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function getProductTypeById($productTypeId): ?ProductType
    {
        // Read the JSON file contents
        $json = file_get_contents($this->dataFile);

        // Decode the JSON into an array of objects
        $data = json_decode($json);

        // Search for the productType by ID in the array
        foreach ($data as $productType) {
            if ($productType->id == $productTypeId) {
                if (!isset($productType->id) || !isset($productType->name) || !isset($productType->canBeInsured)) {
                    return null;
                }

                return new ProductType(
                    $productType->id,
                    $productType->name,
                    $productType->canBeInsured
                );
            }
        }

        return null; // ProductType not found
    }
}