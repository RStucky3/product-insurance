<?php

namespace App\interfaces;

use App\models\ProductType;

interface ProductTypeRepositoryInterface
{
    public function getProductTypeById($productTypeId): ?ProductType;
}