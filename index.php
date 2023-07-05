<?php

namespace App;

use App\calculators\InsuranceCalculator;
use App\controllers\ProductController;
use App\controllers\ProductInsuranceController;
use App\controllers\ProductTypeController;
use App\Repositories\JsonProductRepository;
use App\Repositories\JsonProductTypeRepository;
use App\Utils\HttpStatus;

header('Content-Type: application/json');

require_once __DIR__ . '/vendor/autoload.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Remove query parameters from the URI, if any
$requestUri = explode('?', $requestUri)[0];

// Instantiate the repository with the JSON file path
$productRepository = new JsonProductRepository('data/products.json');
$productTypeRepository = new JsonProductTypeRepository('data/productTypes.json');

$insuranceCalculator = new InsuranceCalculator();

// Instantiate the controller with the repository dependency
$productController = new ProductController($productRepository);
$productTypeController = new ProductTypeController($productTypeRepository);
$productInsuranceController = new ProductInsuranceController($productRepository, $productTypeRepository,$insuranceCalculator);

if ($requestMethod === 'GET' && preg_match('/^\/product\/(\d+)$/', $requestUri, $matches)) {
    $productId = $matches[1];
    $response = $productController->getProductById($productId);

    http_response_code($response);
} else if ($requestMethod === 'GET' && preg_match('/^\/product-type\/(\d+)$/', $requestUri, $matches)) {
    $productTypeId = $matches[1];
    $response = $productTypeController->getProductTypeById($productTypeId);

    http_response_code($response);
} else if ($requestMethod === 'GET' && preg_match('/^\/product-insurance\/(\d+)$/', $requestUri, $matches)) {
    $productId = $matches[1];
    $response = $productInsuranceController->getProductInsurance($productId);

    http_response_code($response);
} else {
    // Handle 404 error for invalid routes
    http_response_code(HttpStatus::BAD_REQUEST);

    echo 'Bad request';
}
