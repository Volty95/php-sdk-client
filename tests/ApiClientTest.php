<?php

use PHPUnit\Framework\TestCase;
use Remesita\ApiClient;

class RemesitaSDKTest extends TestCase
{
    private $ApiClient;

    protected function setUp(): void
    {
        // Aquí puedes inicializar tu objeto ApiClient con claves de prueba si las tienes.
        $this->ApiClient = new ApiClient('YOUR_TEST_API_KEY', 'YOUR_TEST_API_SECRET');
    }

    public function testAuthenticate()
    {
        $response = $this->ApiClient->authenticate();
        $this->assertInstanceOf(AuthResponse::class, $response);
        $this->assertNotNull($response->accessToken);
    }

    public function testGetBusinesses()
    {
        $businesses = $this->ApiClient->getBusinesses();
        $this->assertIsArray($businesses);
        foreach ($businesses as $business) {
            $this->assertInstanceOf(Business::class, $business);
        }
    }

    // ... Puedes continuar con pruebas similares para los otros métodos ...

    public function testTransferBetweenAccounts()
    {
        $response = $this->ApiClient->transferBetweenAccounts('testFromAccount', 'testToAccount', 100, 'testMemo');
        $this->assertInstanceOf(TransferBetweenResponse::class, $response);
        // Aquí puedes agregar más aserciones basadas en lo que esperas de la respuesta.
    }

    // ... Continúa con más pruebas ...

    protected function tearDown(): void
    {
        // Limpia los recursos si es necesario.
        $this->ApiClient = null;
    }
}
