<?php

namespace App\Interfaces;

use App\models\Product;

interface ProductRepositoryInterface
{
    public function getProductById($productId): ?Product;
}