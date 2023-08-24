# Swagger\Client\PrepaidCardsApi

All URIs are relative to *https://remesita.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**restV1CardNumberTogglePost**](PrepaidCardsApi.md#restV1CardNumberTogglePost) | **POST** /rest/v1/card/{number}/toggle | Bloquea o desbloquea una tarjeta
[**restV1CardNumberTransactionsPgPgSizeGet**](PrepaidCardsApi.md#restV1CardNumberTransactionsPgPgSizeGet) | **GET** /rest/v1/card/{number}/transactions/{pg}/{pgSize} | Obtiene las transacciones de una tarjeta
[**restV1CardTransferBetweenPost**](PrepaidCardsApi.md#restV1CardTransferBetweenPost) | **POST** /rest/v1/card/transfer-between | Transfiere saldo entre cuentas Remesita
[**restV1CardsGet**](PrepaidCardsApi.md#restV1CardsGet) | **GET** /rest/v1/cards | Obtiene la lista de tarjetas prepagadas


# **restV1CardNumberTogglePost**
> \Swagger\Client\Model\InlineResponse2002 restV1CardNumberTogglePost($number)

Bloquea o desbloquea una tarjeta

Cambia el estado de bloqueo de una tarjeta específica

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Bearer
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\PrepaidCardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$number = "number_example"; // string | Número de tarjeta

try {
    $result = $apiInstance->restV1CardNumberTogglePost($number);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrepaidCardsApi->restV1CardNumberTogglePost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **number** | **string**| Número de tarjeta |

### Return type

[**\Swagger\Client\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **restV1CardNumberTransactionsPgPgSizeGet**
> \Swagger\Client\Model\InlineResponse2003 restV1CardNumberTransactionsPgPgSizeGet($number, $pg, $pg_size)

Obtiene las transacciones de una tarjeta

Recupera una lista paginada de transacciones para una tarjeta específica

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Bearer
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\PrepaidCardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$number = "number_example"; // string | Número de tarjeta
$pg = 56; // int | Número de página
$pg_size = 56; // int | Tamaño de página

try {
    $result = $apiInstance->restV1CardNumberTransactionsPgPgSizeGet($number, $pg, $pg_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrepaidCardsApi->restV1CardNumberTransactionsPgPgSizeGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **number** | **string**| Número de tarjeta |
 **pg** | **int**| Número de página |
 **pg_size** | **int**| Tamaño de página |

### Return type

[**\Swagger\Client\Model\InlineResponse2003**](../Model/InlineResponse2003.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **restV1CardTransferBetweenPost**
> \Swagger\Client\Model\InlineResponse2001 restV1CardTransferBetweenPost($body)

Transfiere saldo entre cuentas Remesita

Permite transferir saldo entre dos cuentas Remesita especificadas por los números de tarjeta Visa.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Bearer
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\PrepaidCardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \Swagger\Client\Model\Body(); // \Swagger\Client\Model\Body | Detalles de la transferencia

try {
    $result = $apiInstance->restV1CardTransferBetweenPost($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrepaidCardsApi->restV1CardTransferBetweenPost: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\Body**](../Model/Body.md)| Detalles de la transferencia |

### Return type

[**\Swagger\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **restV1CardsGet**
> \Swagger\Client\Model\InlineResponse2004 restV1CardsGet()

Obtiene la lista de tarjetas prepagadas

Devuelve una lista de todas las tarjetas prepagadas en el sistema

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Bearer
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\PrepaidCardsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->restV1CardsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrepaidCardsApi->restV1CardsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**\Swagger\Client\Model\InlineResponse2004**](../Model/InlineResponse2004.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

