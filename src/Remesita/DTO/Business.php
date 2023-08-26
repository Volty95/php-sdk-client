<?php

namespace Remesita\DTO;

/**
 * Class Business
 * @package Remesita\DTO
 * 
 * @property-read string $id
 * @property-read string $name
 * @property-read string $description
 * @property-read string $logo
 * @property-read string $domain
 */
class Business {
    private $id;
    private $name;
    private $description;
    private $logo;
    private $domain;

    private function __construct() {}

    /**
     * Static factory method to create a Business instance from an associative array.
     * 
     * @param array $data
     * @return Business
     */
    public static function create(array $data): Business {
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
