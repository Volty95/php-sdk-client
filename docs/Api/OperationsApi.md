# Swagger\Client\OperationsApi

All URIs are relative to *https://remesita.com*

Method | HTTP request | Description
------------- | ------------- | -------------
[**restV1OperationOrdersGet**](OperationsApi.md#restV1OperationOrdersGet) | **GET** /rest/v1/operation/orders | Obtiene una lista de órdenes
[**restV1OperationP2pGet**](OperationsApi.md#restV1OperationP2pGet) | **GET** /rest/v1/operation/p2p | Obtiene una lista de operaciones P2P


# **restV1OperationOrdersGet**
> \Swagger\Client\Model\InlineResponse2005 restV1OperationOrdersGet($pg, $pg_size, $start, $end, $status)

Obtiene una lista de órdenes

Recupera una lista paginada de órdenes

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Bearer
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\OperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pg = 1; // int | Número de página
$pg_size = 25; // int | Cantidad de elementos por página
$start = new \DateTime("2023-01-01"); // \DateTime | Fecha de inicio en formato Y-m-d H:i:s
$end = new \DateTime("2025-01-01"); // \DateTime | Fecha de finalización en formato Y-m-d H:i:s
$status = "status_example"; // string | Estado para filtrar

try {
    $result = $apiInstance->restV1OperationOrdersGet($pg, $pg_size, $start, $end, $status);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OperationsApi->restV1OperationOrdersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **pg** | **int**| Número de página | [optional] [default to 1]
 **pg_size** | **int**| Cantidad de elementos por página | [optional] [default to 25]
 **start** | **\DateTime**| Fecha de inicio en formato Y-m-d H:i:s | [optional] [default to 2023-01-01]
 **end** | **\DateTime**| Fecha de finalización en formato Y-m-d H:i:s | [optional] [default to 2025-01-01]
 **status** | **string**| Estado para filtrar | [optional]

### Return type

[**\Swagger\Client\Model\InlineResponse2005**](../Model/InlineResponse2005.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **restV1OperationP2pGet**
> \Swagger\Client\Model\InlineResponse2006 restV1OperationP2pGet($pg, $pg_size, $start, $end)

Obtiene una lista de operaciones P2P

Recupera una lista paginada de operaciones P2P

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Bearer
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new Swagger\Client\Api\OperationsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pg = 1; // int | Número de página
$pg_size = 25; // int | Cantidad de elementos por página
$start = new \DateTime("2022-01-01"); // \DateTime | Fecha de inicio en formato Y-m-d H:i:s
$end = new \DateTime("2025-01-01"); // \DateTime | Fecha de finalización en formato Y-m-d H:i:s

try {
    $result = $apiInstance->restV1OperationP2pGet($pg, $pg_size, $start, $end);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OperationsApi->restV1OperationP2pGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **pg** | **int**| Número de página | [optional] [default to 1]
 **pg_size** | **int**| Cantidad de elementos por página | [optional] [default to 25]
 **start** | **\DateTime**| Fecha de inicio en formato Y-m-d H:i:s | [optional] [default to 2022-01-01]
 **end** | **\DateTime**| Fecha de finalización en formato Y-m-d H:i:s | [optional] [default to 2025-01-01]

### Return type

[**\Swagger\Client\Model\InlineResponse2006**](../Model/InlineResponse2006.md)

### Authorization

[Bearer](../../README.md#Bearer)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

