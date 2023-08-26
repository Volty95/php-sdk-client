<?php

namespace Remesita\DTO;

/**
 * Class CardTransaction
 * @package Remesita\DTO
 * 
 * @property-read int $id
 * @property-read string $type
 * @property-read string $date
 * @property-read float $amount
 * @property-read float $amountUSD
 * @property-read float $exchangeRate
 * @property-read string $currency
 * @property-read string $memo
 * @property-read string $category
 * @property-read string $payee
 * @property-read string $website
 * @property-read string $status
 */
class CardTransaction {
    private $id;
    private $type;
    private $date;
    private $amount;
    private $amountUSD;
    private $exchangeRate;
    private $currency;
    private $memo;
    private $category;
    private $payee;
    private $website;
    private $status;

    private function __construct() {}

    /**
     * Static factory method to create a CardTransaction instance from an associative array.
     * 
     * @param array $data
     * @return CardTransaction
     */
    public static function create(array $data): CardTransaction {
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
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        throw new \InvalidArgumentException("Property {$property} does not exist in " . __CLASS__);
    }
}
