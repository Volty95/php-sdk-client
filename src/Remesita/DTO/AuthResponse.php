<?php

namespace Remesita\DTO;

/**
 * Class AuthResponse
 * @package Remesita\DTO
 * 
 * @property-read string $accessToken
 * @property-read User $user
 */
class AuthResponse
{
    /** @var string */
    private $accessToken;

    /** @var User */
    private $user;

    private function __construct()
    {
    }

    /**
     * Static factory method to create an AuthResponse instance from an associative array.
     * 
     * @param array $data
     * @return AuthResponse
     */
    public static function create(array $data): AuthResponse
    {
        $instance = new self();

        if (isset($data['accessToken'])) {
            $instance->accessToken = $data['accessToken'];
        }

        if (isset($data['user'])) {
            if ($data['user'] instanceof User)
                $instance->user = $data['user'];
            else 
            $instance->user = User::create($data['user']);
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
