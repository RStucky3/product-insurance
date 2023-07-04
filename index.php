<?php

use calculators\InsuranceCalculator;
use controllers\ProductController;
use controllers\ProductTypeController;
use repositories\JsonProductRepository;
use repositories\JsonProductTypeRepository;
use templates\errorCodes;

require_once 'src/interfaces/ProductRepositoryInterface.php';
require_once 'src/interfaces/ProductTypeRepositoryInterface.php';
require_once 'src/interfaces/InsuranceCalculatorInterface.php';
require_once 'src/repositories/JsonProductRepository.php';
require_once 'src/repositories/JsonProductTypeRepository.php';
require_once 'src/controllers/ProductController.php';
require_once 'src/controllers/ProductTypeController.php';
require_once 'src/calculators/InsuranceCalculator.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Remove query parameters from the URI, if any
$requestUri = explode('?', $requestUri)[0];

// Instantiate the repository with the JSON file path
$productRepository = new JsonProductRepository('src/data/products.json');
$productTypeRepository = new JsonProductTypeRepository('src/data/productTypes.json');

$insuranceCalculator = new InsuranceCalculator();

// Instantiate the controller with the repository dependency
$productController = new ProductController($productRepository, $insuranceCalculator);
$productTypeController = new ProductTypeController($productTypeRepository);

if ($requestMethod === 'GET' && preg_match('/^\/products\/(\d+)$/', $requestUri, $matches)) {
    $productId = $matches[1];
    $product = $productController->getProductById($productId);

    if ($product) {
        // Prepare the response data
        $response = [
            'id' => $product->id,
            'name' => $product->name,
            'salesPrice' => $product->salesPrice,
            'productTypeId' => $product->productTypeId
        ];

        // Return the response
        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode($response);
    } else {
        // Handle product not found
        http_response_code(404);
        echo 'Product not found';
    }
} else if ($requestMethod === 'GET' && preg_match('/^\/productType\/(\d+)$/', $requestUri, $matches)) {
    $productTypeId = $matches[1];
    $productType = $productTypeController->getProductTypeById($productTypeId);

    if ($productType) {
        // Prepare the response data
        $response = [
            'id' => $productType->id,
            'name' => $productType->name,
            'canBeInsured' => $productType->canBeInsured,
        ];

        // Return the response
        header('Content-Type: application/json');
        http_response_code(201);
        echo json_encode($response);
    } else {
        // Handle productType not found
        http_response_code(404);
        echo 'Product type not found';
    }
} else if ($requestMethod === 'GET' && preg_match('/^\/productInsurance\/(\d+)$/', $requestUri, $matches)) {
    $productId = $matches[1];
    $product = $productController->getProductById($productId);

    if ($product) {
        // Get the product type based on the productTypeId
        $productType = $productTypeController->getProductTypeById($product->productTypeId);

        if ($productType) {
            // Get the insurance price
            $insurancePrice = $productController->getProductInsurance($product, $productType);

            // If insurance price is 0 no insurance is needed
            // If the controller sends -1 back the product can not be insured
            if ($insurancePrice === 0) {
                echo 'Product does not need to be insured';
            }
            else if ($insurancePrice === -1) {
                echo 'Product does not need to be insured';
            }
            else {
                echo 'The cost of the insurance is ' . $insurancePrice . '.-';
            }

            http_response_code(201);
        }
        else {
            // Handle productType not found
            http_response_code(404);
            echo 'Product type not found';
        }
    }
    else {
        // Handle product not found
        http_response_code(404);
        echo 'Product not found';
    }
} else {
    // Handle 404 error for invalid routes
    http_response_code(404);
    echo '404 Not Found';
}
