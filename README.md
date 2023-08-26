# API de Remesita

La clase `RemesitaAPI` proporciona una interfaz fácil de usar para interactuar con el servicio de Remesita. Esta clase cubre varias funcionalidades, incluyendo autenticación, obtención de negocios, transferencias entre cuentas, y más.

## Instalación

Asegúrate de tener instalado PHP y Composer en tu proyecto. Luego, puedes incluir la clase `ApiClient` en tu proyecto.

## Uso

### Inicialización

Para comenzar, necesitas inicializar la clase con tu `apiKey` y `apiSecret`:

```php
use Remesita\ApiClient;

$apiKey = "TU_API_KEY";
$apiSecret = "ApiClient";
$remesita = new ApiClient($apiKey, $apiSecret);
```

### Autenticación

La autenticación se maneja automáticamente dentro de la clase. Sin embargo, si deseas autenticarte manualmente, puedes hacerlo y ademas de obtener el token puedes obtener datos de usuario:

```php
$response = $remesita->authenticate();
$token = $response->accessToken;
$user = $response->user;
```

### Obtener Negocios

Para obtener una lista de negocios:

```php
/**
 * @var Remesita\DTO\Business[] $businesses
 */
$businesses = $remesita->getBusinesses();
```

### Transferencias entre cuentas

Para realizar una transferencia entre cuentas:

```php
/**
 * @var Remesita\DTO\TransferBetweenResponse $response
 */
$response = $remesita->transferBetweenAccounts("tarjta_origen", "tarjeta_destino", 100.50, "Transferencia de prueba");
```

### Cambiar estado de tarjeta

Para bloquear o desbloquear una tarjeta:

```php
$response = $remesita->toggleCardStatus("NUMERO_DE_TARJETA");
```


### Lista de negocios registrados

```php
/** 
 * @var Remesita\DTO\Business $b
 */
foreach($remesita->getBusinesses()  as $b){
    echo $b->id;
    echo $b->name;
    echo $b->logo;
    echo $b->description;
    echo $b->domain;
}
```

### Lista de tarjetas

```php
/** 
 * @var Remesita\DTO\Card $c
 */
foreach($remesita->getCards()  as $c){
    echo $b->number;
    echo $b->balance; 
}
```

### Lista de transaccones de una tarjeta
```php
  
$from = new \DateTime("now - 30 days");
$to = new \DateTime("now");
$pg=1;
$pgSize=25;
$paggination=$remesita->getCardTransactions(
    $cardNumber,
    $from,
    $to,
    $pg,
    $pgSize
);

echo $paggination->total;
echo $paggination->pg;
echo $paggination->pgSize;
if($paggination->allowNext) {

}
/** 
 * $paggination implementa la interfaz \Iterator
 * @var Remesita\DTO\CardTransaction $c
 */
foreach($paggination  as $t){
    echo $t->amount;
    echo $t->type; //DBT or CRD
    echo $t->currency; 
    echo $t->date; 
    echo $t->memo; 
    echo $t->exchangeRate; //rate to USD
}
```


### Lista de ordenes
```php
  
$from = new \DateTime("now - 30 days");
$to = new \DateTime("now");
$pg=1;
$pgSize=25;
$paggination=$remesita->getOrders( 
    $from,
    $to,
    $pg,
    $pgSize
); 
/** 
 * $paggination implementa la interfaz \Iterator
 * @var Remesita\DTO\Order $o
 */
foreach($paggination  as $o){
    echo $o->reference; 
    echo $o->sku; 
    echo $o->recipientAmount; 
}
```


## Creando link de pagos
```php
$myBusinessUnitId="a365366c-261f-11ed-9ef1-024206050103";
$concept= "Toma chocolate paga lo que debes";
$amount=101.99;

$myExternalOrderCartId="MYID123"; //optional 
$payerName="YESAPIN GARCIA"; //optional
$payerPhone="+17863052277"; //optional
$payerEmail="yesapin@gmail.com"; //optional

/** 
 * @var Remesita\DTO\PaymentLinkResponse $pl
 */
$pl=$api->createPaymentLink(
    $myBusinessUnitId,
    $amount,
    $concept,
    $myExternalOrderCartId, //optional
    "https://miweb.com/ipn?id=$myExternalOrderCartId", //optional
    "https://miweb.com/checkout/success", //optional
    "https://miweb.com/checkout/canceled", //optional
    $payerName, //optional
    $payerPhone, //optional
    $payerEmail //optional
);

echo $pl->link;
```

## Manejo de errores

La clase `ApiClient` lanza excepciones en caso de errores. Asegúrate de manejar estas excepciones adecuadamente en tu código.

```php
try {
    $response = $remesita->getBusinesses();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```


## Pruebas
Para ejecutar las pruebas, simplemente usa el comando:
```shel
phpunit RemesitaSDKTest.php 
```


## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue si encuentras un bug o si tienes alguna sugerencia de mejora.

## Licencia

Este proyecto está bajo la licencia MIT.
