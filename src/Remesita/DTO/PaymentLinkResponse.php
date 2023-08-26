<?php

namespace Remesita\DTO;

/**
 * Class PaymentLinkResponse
 * @package Remesita\DTO
 * 
 * @property-read string $link
 */
class PaymentLinkResponse {
    private $link;

    private function __construct() {}

    /**
     * Static factory method to create a PaymentLinkResponse instance from an associative array.
     * 
     * @param array $data
     * @return PaymentLinkResponse
     */
    public static function create(array $data): PaymentLinkResponse {
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
