<?php

namespace Remesita\DTO;

/**
 * Class Order
 * @package Remesita\DTO
 *  
 * @property-read string $reference; 
 *  @property-read string $status; 
 *  @property-read string $speedMode; 
 *  @property-read string $sku;  
 *  @property-read string $swift; 
 *  @property-read string $institution; 
 *  @property-read string $senderName; 
 *  @property-read string $senderCountry; 
 *  @property-read string $recipientAmount; 
 *  @property-read string $recipientCurrency; 
 *  @property-read string $recipientName; 
 *  @property-read string $recipientCountry; 
 *  @property-read string $recipientRelationship; 
 *  @property-read string $paymentMethod; 
 *  @property-read string $quotation; 
 *  @property-read string $senderCurrency; 
 *  @property-read string $exchangeRate; 
 *  @property-read string $lifeTime; 
 *  @property-read string $createdAt; 
 *  @property-read string $payedAt; 
 *  @property-read string $cancelAt; 
 *  @property-read string $completedAt; 
 *  @property-read string $institutionIcon; 
 *  @property-read string $cancelReason; 
 *  @property-read string $intent;  
 */
class Order
{
    private $reference;
    private $status;
    private $speedMode;
    private $sku;
    private $swift;
    private $institution;
    private $senderName;
    private $senderCountry;
    private $recipientAmount;
    private $recipientCurrency;
    private $recipientName;
    private $recipientCountry;
    private $recipientRelationship;
    private $paymentMethod;
    private $quotation;
    private $senderCurrency;
    private $exchangeRate;
    private $lifeTime;
    private $createdAt;
    private $payedAt;
    private $cancelAt;
    private $completedAt;
    private $institutionIcon;
    private $cancelReason;
    private $intent;

    private function __construct()
    {
    }

    /**
     * Static factory method to create an Order instance from an associative array.
     * 
     * @param array $data
     * @return Order
     */
    public static function create(array $data): Order
    {
        $instance = new self();

        $reflection = new \ReflectionClass($instance);
        foreach ($data as $key => $value) {
            if ($reflection->hasProperty($key)) {
                $property = $reflection->getProperty($key);
                $property->setAccessible(true);
                $property->setValue($instance, $value);
            }
        }

        return $instance;
    }

    /**
     * Magic method to get properties.
     * 
     * @param string $property
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        throw new \InvalidArgumentException("Property {$property} does not exist in " . __CLASS__);
    }
}
