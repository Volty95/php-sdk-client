<?php

namespace Remesita\DTO;

/**
 * Class P2POperation
 * @package Remesita\DTO
 * 
 * @property-read bool $match
 * @property-read string $status
 * @property-read string $order
 * @property-read string $createdAt
 * @property-read string $completedAt
 * @property-read string $paymentMethod
 * @property-read string $sku
 * @property-read float $quotation
 * @property-read string $quotationCurrency
 * @property-read string $recipientAccount
 * @property-read float $recipientAmount
 */
class P2POperation {
    private $match;
    private $status;
    private $order;
    private $createdAt;
    private $completedAt;
    private $paymentMethod;
    private $sku;
    private $quotation;
    private $quotationCurrency;
    private $recipientAccount;
    private $recipientAmount;

    private function __construct() {}

    /**
     * Static factory method to create a P2POperation instance from an associative array.
     * 
     * @param array $data
     * @return P2POperation
     */
    public static function create(array $data): P2POperation {
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
    
