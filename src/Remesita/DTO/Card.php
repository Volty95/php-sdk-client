<?php

namespace Remesita\DTO;

/**
 * Class Card
 * @package Remesita\DTO
 * 
 * @property-read float $balance
 * @property-read string $balanceFormatted
 * @property-read float $balanceUSD
 * @property-read string $balanceUSDFormatted
 * @property-read string $status
 * @property-read string $number
 * @property-read string $numberFormatted
 * @property-read float $exchangeRate
 * @property-read string $clabe
 * @property-read string $cashReference
 * @property-read bool $locked
 * @property-read string $alias
 * @property-read bool $main
 */
class Card {
    private $balance;
    private $balanceFormatted;
    private $balanceUSD;
    private $balanceUSDFormatted;
    private $status;
    private $number;
    private $numberFormatted;
    private $exchangeRate;
    private $clabe;
    private $cashReference;
    private $locked;
    private $alias;
    private $main;

    private function __construct() {}

    /**
     * Static factory method to create a Card instance from an associative array.
     * 
     * @param array $data
     * @return Card
     */
    public static function create(array $data): Card {
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
