<?php

namespace repositories;

use ProductTypeRepositoryInterface;

class JsonProductTypeRepository implements ProductTypeRepositoryInterface
{
    private $dataFile;

    public function __construct($dataFile)
    {
        $this->dataFile = $dataFile;
    }

    public function getProductTypeById($productTypeId)
    {
        // Read the JSON file contents
        $json = file_get_contents($this->dataFile);

        // Decode the JSON into an array of objects
        $data = json_decode($json);

        // Search for the productType by ID in the array
        foreach ($data as $productType) {
            if ($productType->id == $productTypeId) {
                return $productType;
            }
        }

        return null; // ProductType not found
    }
}