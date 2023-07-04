<?php

use controllers\ProductController;
use repositories\JsonProductRepository;

require_once 'src/interfaces/ProductRepositoryInterface.php';
require_once 'src/repositories/JsonProductRepository.php';
require_once 'src/controllers/ProductController.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Remove query parameters from the URI, if any
$requestUri = explode('?', $requestUri)[0];

// Instantiate the repository with the JSON file path
$productRepository = new JsonProductRepository('src/data/products.json');

// Instantiate the controller with the repository dependency
$productController = new ProductController($productRepository);

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
} else {
    // Handle 404 error for invalid routes
    http_response_code(404);
    echo '404 Not Found';
}
