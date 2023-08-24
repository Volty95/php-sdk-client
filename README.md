# SwaggerClient-php
Api de remesita.com para desarrolladores. Primero obten tu apiKey y apiSecret, y para autenticarte debes ejecutar el endpoint rest/v1/auth en la respuesta obtendrás un token de acceso que debes usar en el resto de peticiones

- API version: 1.0.0
- Build package: io.swagger.codegen.languages.PhpClientCodegen

## Requirements

PHP 5.5 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com//.git"
    }
  ],
  "require": {
    "/": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/SwaggerClient-php/vendor/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Bearer
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\AuthenticationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Swagger\Client\Model\Body2(); // \Swagger\Client\Model\Body2 | JSON con api_key y api_secret

try {
    $result = $apiInstance->restV1AuthPost($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AuthenticationApi->restV1AuthPost: ', $e->getMessage(), PHP_EOL;
}

?>
```

## Documentation for API Endpoints

All URIs are relative to *https://remesita.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AuthenticationApi* | [**restV1AuthPost**](docs/Api/AuthenticationApi.md#restv1authpost) | **POST** /rest/v1/auth | Autentica al usuario con api_key y api_secret
*BusinessApi* | [**restV1BusinessGet**](docs/Api/BusinessApi.md#restv1businessget) | **GET** /rest/v1/business | Obtiene la lista de negocios registrados
*BusinessApi* | [**restV1PaymentLinkPost**](docs/Api/BusinessApi.md#restv1paymentlinkpost) | **POST** /rest/v1/payment-link | Genera un link de pago
*DefaultApi* | [**restV1UserLockupCodeCodeGet**](docs/Api/DefaultApi.md#restv1userlockupcodecodeget) | **GET** /rest/v1/user/lockup-code/{code} | Obtener datos de un cliente a partir de su codigo de cliente/referidos
*OperationsApi* | [**restV1OperationOrdersGet**](docs/Api/OperationsApi.md#restv1operationordersget) | **GET** /rest/v1/operation/orders | Obtiene una lista de órdenes
*OperationsApi* | [**restV1OperationP2pGet**](docs/Api/OperationsApi.md#restv1operationp2pget) | **GET** /rest/v1/operation/p2p | Obtiene una lista de operaciones P2P
*PrepaidCardsApi* | [**restV1CardNumberTogglePost**](docs/Api/PrepaidCardsApi.md#restv1cardnumbertogglepost) | **POST** /rest/v1/card/{number}/toggle | Bloquea o desbloquea una tarjeta
*PrepaidCardsApi* | [**restV1CardNumberTransactionsPgPgSizeGet**](docs/Api/PrepaidCardsApi.md#restv1cardnumbertransactionspgpgsizeget) | **GET** /rest/v1/card/{number}/transactions/{pg}/{pgSize} | Obtiene las transacciones de una tarjeta
*PrepaidCardsApi* | [**restV1CardTransferBetweenPost**](docs/Api/PrepaidCardsApi.md#restv1cardtransferbetweenpost) | **POST** /rest/v1/card/transfer-between | Transfiere saldo entre cuentas Remesita
*PrepaidCardsApi* | [**restV1CardsGet**](docs/Api/PrepaidCardsApi.md#restv1cardsget) | **GET** /rest/v1/cards | Obtiene la lista de tarjetas prepagadas
*ProfileApi* | [**restV1BalanceGet**](docs/Api/ProfileApi.md#restv1balanceget) | **GET** /rest/v1/balance | Obtiene datos de balance
*ProfileApi* | [**restV1UserLockupCodeCodePost**](docs/Api/ProfileApi.md#restv1userlockupcodecodepost) | **POST** /rest/v1/user/lockup-code/{code} | Obtener datos de un cliente a partir de su codigo de cliente/referidos


## Documentation For Models

 - [Body](docs/Model/Body.md)
 - [Body1](docs/Model/Body1.md)
 - [Body2](docs/Model/Body2.md)
 - [InlineResponse200](docs/Model/InlineResponse200.md)
 - [InlineResponse2001](docs/Model/InlineResponse2001.md)
 - [InlineResponse2002](docs/Model/InlineResponse2002.md)
 - [InlineResponse2003](docs/Model/InlineResponse2003.md)
 - [InlineResponse2003Items](docs/Model/InlineResponse2003Items.md)
 - [InlineResponse2004](docs/Model/InlineResponse2004.md)
 - [InlineResponse2004Items](docs/Model/InlineResponse2004Items.md)
 - [InlineResponse2005](docs/Model/InlineResponse2005.md)
 - [InlineResponse2005Items](docs/Model/InlineResponse2005Items.md)
 - [InlineResponse2006](docs/Model/InlineResponse2006.md)
 - [InlineResponse2006Items](docs/Model/InlineResponse2006Items.md)
 - [InlineResponse2007](docs/Model/InlineResponse2007.md)
 - [InlineResponse2008](docs/Model/InlineResponse2008.md)
 - [InlineResponse2008User](docs/Model/InlineResponse2008User.md)
 - [InlineResponse2009](docs/Model/InlineResponse2009.md)
 - [InlineResponse401](docs/Model/InlineResponse401.md)
 - [InlineResponse404](docs/Model/InlineResponse404.md)


## Documentation For Authorization


## Bearer

- **Type**: API key
- **API key parameter name**: Authorization
- **Location**: HTTP header


## Author




