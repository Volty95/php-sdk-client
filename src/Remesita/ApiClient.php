<?php

namespace Remesita;

use Remesita\DTO\AuthResponse;
use Remesita\DTO\Balance;
use Remesita\DTO\Business;
use Remesita\DTO\Card;
use Remesita\DTO\CardToggleResponse;
use Remesita\DTO\CardTransaction;
use Remesita\DTO\Order;
use Remesita\DTO\P2POperation;
use Remesita\DTO\PaymentLinkResponse;
use Remesita\DTO\TransferBetweenResponse;
use Remesita\DTO\User;
use Remesita\DTO\Paggination;

class ApiClient
{
    private $baseURL = 'https://api.remesita.com';
    private $apiKey;
    private $apiSecret;
    private $token = null;
    private $token = null;

    public function __construct(string $apiKey, string $apiSecret, $env="prod")
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        if($env!="prod")
            $this->baseURL='https://dev-api.remesita.com';
    }

    private function auth(): void
    {
        if (!$this->token) {
            $this->token = $this->authenticate()->accessToken;
        }
    }

    private function makeRequest(string $endpoint, string $method = 'GET', array $data = []): array
    {
        $ch = curl_init();

        if ($method === 'GET' && !empty($data)) {
            $endpoint .= '?' . http_build_query($data);
        }

        $headers = [
            'Content-Type: application/json'
        ];
        if ($this->token) {
            $headers[] = 'Authorization: ' . $this->token;
        }

        curl_setopt($ch, CURLOPT_URL, $this->baseURL . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            return json_decode($response, true);
        } else {
            $error = json_decode($response, true)['error'] ?? 'Error making request to ' . $endpoint;
            throw new \Exception($error);
        }
    }

    /**
     * Autentica al usuario usando las credenciales proporcionadas en el constructor.
     *
     * @throws \Exception Si la autenticación falla.
     * @return AuthResponse Retorna un objeto AuthResponse con el token de acceso y la información del usuario.
     */
    public function authenticate(): AuthResponse
    {
        $data = $this->makeRequest('/rest/v1/auth', 'POST', [
            'api_key' => $this->apiKey,
            'api_secret' => $this->apiSecret
        ]);

        $this->token = $data['accessToken'];

        // Utilizar el método create para construir una instancia del DTO User
        $user = User::create($data['user']);

        // Crear y retornar una instancia del DTO AuthResponse
        return AuthResponse::create([
            'accessToken' => $data['accessToken'],
            'user' => $user
        ]);
    }
    /**
     *  @return Card[] Un array de objetos DTO `Cards` las tarjetas remesita asociadas a tu cuentya. 
     * @throws \Exception Si hay un error durante la solicitud o si la autenticación falla. 
     */
    public function getCards(): array
    {
        $this->auth();
        $data = $this->makeRequest('/rest/v1/cards');
        $cards = [];
        foreach ($data["items"] ?? [] as $cardData) {
            $cards[] = Card::create($cardData);
        }
        return $cards;
    }
    /**
     *  @return Business[] Un array de objetos DTO `Business` que representan los negocios recuperados. 
     * @throws \Exception Si hay un error durante la solicitud o si la autenticación falla. 
     */
    public function getBusinesses(): array
    {
        $this->auth();
        $data = $this->makeRequest('/rest/v1/business');

        $businesses = [];
        foreach ($data as $businessData) {
            $businesses[] = Business::create($businessData);
        }
        return $businesses;
    }
    /**
     * Realiza una transferencia entre cuentas.
     *
     * @param string $from Cuenta de origen.
     * @param string $to Cuenta destino.
     * @param float $amount Monto a transferir.
     * @param string $memo Nota o memo de la transferencia.
     * @param string|null $currency Moneda de la transferencia (opcional).
     *
     * @return TransferBetweenResponse Retorna una respuesta con el resultado de la transferencia.
     */
    public function transferBetweenAccounts(
        string $from,
        string $to,
        float $amount,
        string $memo,
        ?string $currency = null
    ): ?TransferBetweenResponse {
        $postData = [
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
            'memo' => $memo
        ];

        if ($currency) {
            $postData['currency'] = $currency;
        }

        try {
            $this->auth();
            $response = $this->makeRequest('POST', '/rest/v1/card/transfer-between', $postData);
            return TransferBetweenResponse::create($response);
        } catch (\Exception $e) {
            return TransferBetweenResponse::create(["error" => $e->getMessage(), "success" => false]);
        }
    }

    /**
     * Cambia el estado de una tarjeta (bloquear/desbloquear).
     *
     * @param string $cardNumber numero de la tarjeta que se quiere cambiar de estado.
     *
     * @return CardToggleResponse Retorna una respuesta con el estado actual de la tarjeta.
     */
    public function toggleCardStatus(string $cardNumber): ?CardToggleResponse
    {
        $endpoint = "/rest/v1/card/{$cardNumber}/toggle";

        try {
            $this->auth();
            $response = $this->makeRequest('POST', $endpoint);
            return CardToggleResponse::create($response);
        } catch (\Exception $e) {
            return CardToggleResponse::create([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    /**
     * Fetches transactions for a specific card.
     *
     * @param string $cardNumber The card number.
     * @param \DateTime|null $startDate Optional start date for filtering transactions.
     * @param \DateTime|null $endDate Optional end date for filtering transactions.
     * @param int|null $pg Optional page number.
     * @param int|null $pgSize Optional page size.
     * @return \Remesita\DTO\CardTransactionPaggination list pagginated of CardTransaction containing an array of CardTransaction DTOs or an error message.
     * @throws \Exception If there's an error during the request.
     */
    public function getCardTransactions(string $cardNumber, ?\DateTime $from = null, ?\DateTime $to = null, ?int $pg = 1, ?int $pgSize = 25): Paggination
    {
       
        $params = [ 
            'pg' => $pg,
            'pgSize' => $pgSize
        ]; 
        $format = "Y-m-d H:i:s";
        if ($from) 
            $params['from'] =$from->format($format) ;
        
        if ($to) 
            $params['to'] =$to->format($format) ;
        
        try {
            $this->auth();
            $response = $this->makeRequest("/rest/v1/card/{$cardNumber}/transactions/{$pg}/{$pgSize}", 'GET', $params);
            return Paggination::create($response, CardTransaction::class);
        } catch (\Exception $e) {
            return Paggination::create(["error" => $e->getMessage()], CardTransaction::class);
        }
    }

    /**
     * Fetches details for a specific card.
     *
     * @param string $cardNumber The card number.
     * @return \Remesita\DTO\Card|null An Card object containing a Card DTO  or null.
     * @throws \Exception If there's an error during the request.
     */
    public function getCardDetails(string $cardNumber): ?Card
    {
        try {
            $this->auth();
            $response = $this->makeRequest("/rest/v1/card/{$cardNumber}", 'GET');
            $cardDetails = Card::create($response);
            return $cardDetails;
        } catch (\Exception $e) {
            return null;
        }
    }
    /**
     * Fetches a list of orders.
     *
     * @param \DateTime|null $from Optional start date filter.
     * @param \DateTime|null $from Optional end date filter.
     * @param int|null $pg Optional pg.
     * @param int|null $pgSize Optional limit for the number for page
     * @param string|null $status Optional status filter.
     * @return \Remesita\DTO\OrderPaggination 
     * @throws \Exception If there's an error during the request.
     *
     */
    public function getOrders(?\DateTime $from = null, ?\DateTime $to = null, ?int $pg = 1, ?int $pgSize = 25, ?string $status = null): Paggination
    {
        try {
            $format = "Y-m-d H:i:s";
            $params = [
                'from' => !empty($from) ? $from->format($format) : date($format, strtotime("now - 1 year")),
                'to' => !empty($to) ? $to->format($format) : date($format, strtotime("now + 1 day")),
                'pg' => $pg,
                'pgSize' => $pgSize,
                'status' => $status,
                "attrs"=>"reference|status|speedMode|sku|recipientAccount|recipientAmount|recipientAmount|swift|institution|senderName|senderCountry|recipientName|recipientCountry|recipientRelationship|paymentMethod|quotation|senderCurrency|exchangeRate|lifeTime|createdAt|payedAt|cancelAt|completedAt|institutionIcon|cancelReason|intent"
            ];

            // Filter out null values
            $params = array_filter($params, function ($value) {
                return !is_null($value);
            });
            $this->auth();
            $response = $this->makeRequest("/rest/v1/orders", 'GET', $params);
            return  Paggination::create($response, Order::class);
        } catch (\Exception $e) {
            return Paggination::create(["error" => $e->getMessage()], Order::class);
        }
    }
    /**
     * Fetches a list of P2P operations.
     *
     * @param \DateTime|null $from Optional starting date filter.
     * @param \DateTime|null $to Optional ending date filter.
     * @param int|null $pg Optional page number.
     * @param int|null $pgSize Optional page size.
     * @return \Remesita\DTO\Paggination An P2POperation paggination.
     * @throws \Exception If there's an error during the request.
     */
    public function getP2POperations(?\DateTime $from = null, ?\DateTime $to = null, ?int $pg = 1, ?int $pgSize = 25): Paggination
    {

        $format = "Y-m-d H:i:s";
        $params = [
            'from' => !empty($from) ? $from->format($format) : date($format, strtotime("now - 1 year")),
            'to' => !empty($to) ? $to->format($format) : date($format, strtotime("now + 1 day")),
            'pg' => $pg,
            'pgSize' => $pgSize
        ];

        // Filter out null values
        $params = array_filter($params, function ($value) {
            return !is_null($value);
        });
        try {
            $this->auth();
            $response = $this->makeRequest("/rest/v1/p2p", 'GET', $params);
            return Paggination::create($response, P2POperation::class);
        } catch (\Exception $e) {
            return Paggination::create(["error" => $e->getMessage()], P2POperation::class);
        }
    }

    /**
     * Creates a payment link.
     *
     * @param string $businessUnitId The ID of the business unit.
     * @param float $amount The amount for the payment link.
     * @param string|null $concept Optional concept for the payment.
     * @param array|null $methods Optional force use payment method from a list ex: ["PREPAIDCARDBALANCE","ZELLE","SPEI","BIZUM","IBAN","SEIS","USDT","BITCOIN","PAYPAL"]
     * @param string|null $ipnUrl Optional IPN URL.
     * @param string|null $successUrl Optional success URL.
     * @param string|null $cancelUrl Optional cancel URL.
     * @param string|null $customId Optional custom ID.
     * @param string|null $payerName Optional payer's name.
     * @param string|null $payerPhone Optional payer's phone number.
     * @param string|null $payerEmail Optional payer's email.
     * @return \Remesita\DTO\PaymentLinkResponse An PaymentLinkResponse DTO or null.
     * @throws \Exception If there's an error during the request.
     */
    public function createPaymentLink(
        string $businessUnitId,
        float $amount,
        string $concept,
        ?array $methods = null,
        ?string $customId = null,
        ?string $ipnUrl = null,
        ?string $successUrl = null,
        ?string $cancelUrl = null,
        ?string $payerName = null,
        ?string $payerPhone = null,
        ?string $payerEmail = null
    ): ?PaymentLinkResponse {
        $data = [
            'businessUnitId' => $businessUnitId,
            'amount' => $amount,
            'concept' => $concept,
            "methods" => $methods,
            'ipnUrl' => $ipnUrl,
            'successUrl' => $successUrl,
            'cancelUrl' => $cancelUrl,
            'customId' => $customId,
            'payerName' => $payerName,
            'payerPhone' => $payerPhone,
            'payerEmail' => $payerEmail
        ];

        // Remove null values from the data array
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });

        try {
            $this->auth();
            $response = $this->makeRequest("/rest/v1/payment-link", 'POST', $data);
            $paymentLinkResponse = PaymentLinkResponse::create($response);
            return  $paymentLinkResponse;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Retrieves the balance.
     *
     * @return \Remesita\DTO\Balance An   Balance DTO ornull.
     * @throws \Exception If there's an error during the request.
     */
    public function getBalance(): ?Balance
    {
        try {
            $this->auth();
            $response = $this->makeRequest("/rest/v1/balance");

            $balance = Balance::create($response);

            return  $balance;
        } catch (\Exception $e) {
            return  null;
        }
    }
}
