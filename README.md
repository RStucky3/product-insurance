# Product Insurance API

This is a simple API for calculating insurance costs for different products.

## Requirements

- PHP 8.0 or later
- Composer (Dependency Manager)

## Installation

1. Clone the repository or download the source code.
2. Navigate to the project directory: `cd product-insurance`.
3. Install the dependencies using Composer: `composer install`.

## Usage

1. Start the PHP built-in server: `php -S localhost:8000`.
2. Send HTTP requests to the API endpoints.

### API Endpoints

- Product Details
  - URI: `/product/{id}`
  - Endpoint that accepts product id as input and returns the corresponding product information. Where {id} should be replaced with the actual ID of a product. This endpoint returns JSON response.
  - Example product id: 572770
- Product type Details
  - URI: `/product-type/{id}`
  - Endpoint that accepts product type id as input and returns the corresponding product type information. Where {id} should be replaced with the actual ID of a product type. This endpoint returns JSON response.
  - Example product type id: 21
- Product insurance
  - URI: `/product-insurance/{id}`
  - Endpoint that accepts product id and calculates the total cost of insurance for that product. Where {id} should be replaced with the actual ID of a product.
  - Example product id: 572770

## Tests

To run the unit test you need to have composer installed. 

You can find the tests in the test directory located in `tests/tests/unit`