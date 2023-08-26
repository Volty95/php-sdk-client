<?php

namespace Remesita\DTO;

/**
 * Class User
 * @package Remesita\DTO
 * 
 * @property-read string $uid
 * @property-read string $name
 * @property-read string $phone
 * @property-read string $email
 * @property-read string $pictureUrl
 * @property-read string $mainCard
 * @property-read string $level
 * @property-read string $countryISO
 */
class User
{
    private $uid;
    private $name;
    private $phone;
    private $email;
    private $pictureUrl;
    private $mainCard;
    private $level;
    private $countryISO;

    private function __construct()
    {
    }
    /**
     * Static factory method to create a CardToggleResponse instance from an associative array.
     * 
     * @param array $data
     * @return CardToggleResponse
     */
    public static function create(array $data): User
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
