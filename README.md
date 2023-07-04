# product-insurance
At Coolblue we want to be able to insure the products that we sell to customers, so that we get money back in case the product gets lost or damaged before reaching the customers. For that, this REST API can return product information and the insurance necessary to cover the risks of delivering them. ( this is an intake assignment ).

## Setup

### Running

To make sure everyone can run this project, I am running it with the build in server from PHP. If you have PHP installed you can run it using the command `php -S localhost:8000`.

### Reviewing URIs

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

### Tests

To run the test you need to have composer installed. 

Run `composer install`

You can find the tests in the test file located in `src/tests/unit`