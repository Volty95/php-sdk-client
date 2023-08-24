# Body1

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**business_unit_id** | **string** | ID del negocio que está generando el link de pago | 
**amount** | **float** | Monto a pagar | 
**concept** | **string** | Concepto de pago o comentario | 
**ipn_url** | **string** | Dirección para recibir webhooks de notificaciones de pago en segundo plano | [optional] 
**success_url** | **string** | URL a donde redireccionar si el pago es satisfactorio | [optional] 
**cancel_url** | **string** | URL a donde redireccionar si el pago es cancelado | [optional] 
**custom_id** | **string** | Identificador externo para trazabilidad | [optional] 
**payer_name** | **string** | Nombre del pagador (si se conoce) | [optional] 
**payer_phone** | **string** | Teléfono del pagador (si se conoce) | [optional] 
**payer_email** | **string** | Email del pagador (si se conoce) | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


