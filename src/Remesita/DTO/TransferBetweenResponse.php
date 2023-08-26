<?php

namespace Remesita\DTO;

/**
 * Class TransferBetweenResponse
 * @package Remesita\DTO
 * 
 * @property-read bool $success
 * @property-read string|null $error
 * @property-read string|null $tid
 */
class TransferBetweenResponse {
    private $success;
    private $error;
    private $tid;

    private function __construct() {}

    /**
     * Static factory method to create a TransferBetweenResponse instance from an associative array.
     * 
     * @param array $data
     * @return TransferBetweenResponse
     */
    public static function create(array $data): TransferBetweenResponse {
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
