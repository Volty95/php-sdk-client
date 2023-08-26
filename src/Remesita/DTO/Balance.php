<?php

namespace Remesita\DTO;

/**
 * Class Balance
 * @package Remesita\DTO
 * 
 * @property-read float $prepaidCardCombinedBalance
 * @property-read float $prepaidCardCombinedBalanceUsd
 * @property-read float $referralsCommission
 * @property-read float $usd2mxn
 */
class Balance {
    private $prepaidCardCombinedBalance;
    private $prepaidCardCombinedBalanceUsd;
    private $referralsCommission;
    private $usd2mxn;

    private function __construct() {}

    /**
     * Static factory method to create a Balance instance from an associative array.
     * 
     * @param array $data
     * @return Balance
     */
    public static function create(array $data): Balance {
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
