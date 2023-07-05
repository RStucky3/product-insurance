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

// Instantiate the controllers with the repository and calculator dependencies
$productController = new ProductController($productRepository);
$productTypeController = new ProductTypeController($productTypeRepository);
$productInsuranceController = new ProductInsuranceController($productRepository, $productTypeRepository, $insuranceCalculator);

// Define the routes and their corresponding controllers
$routes = [
    '/product' => [
        'controller' => $productController,
        'method' => 'getProductById',
    ],
    '/product-type' => [
        'controller' => $productTypeController,
        'method' => 'getProductTypeById',
    ],
    '/product-insurance' => [
        'controller' => $productInsuranceController,
        'method' => 'getProductInsurance',
    ],
];

// Process the route
$routeFound = false;

foreach ($routes as $route => $handler) {
    $pattern = sprintf('/^%s\/(\d+)$/', preg_quote($route, '/'));
    if (preg_match($pattern, $requestUri, $matches)) {
        $routeFound = true;
        $resourceId = $matches[1];

        $controller = $handler['controller'];
        $method = $handler['method'];

        $response = $controller->$method($resourceId);

        http_response_code($response);
        break;
    }
}

if (!$routeFound) {
    // Handle 404 error for invalid routes
    http_response_code(HttpStatus::BAD_REQUEST);
    echo 'Bad request';
}