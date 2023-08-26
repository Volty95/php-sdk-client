<?php

namespace Remesita\DTO;

/**
 * Class Paggination
 * @package Remesita\DTO
 *  
 * @property-read string $error
 * @property-read bool $allowNext
 * @property-read int $pgSize
 * @property-read int $pg
 * @property-read int $total
 * @property-read array $items
 */
class Paggination  implements \Iterator
{
    private $items=[];
    private $total=0;
    private $pg=1;
    private $pgSize=25;
    private $allowNext=false;
    private $error;


    private $_pos = 0; // Para la implementación de Iterator

    private function __construct()
    {
    }

    /**
     * Static factory method to create an Paggination 
     * 
     * @param array $data
     * @return Paggination
     */
    public static function create(array $data,$itemClass): Paggination
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
        if (!empty($instance->items))
            $instance->items = array_map(function ($i) use ($itemClass) {
                if (is_array($i))
                    $i = $itemClass::create($i);
                return $i;
            }, $instance->items);

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

    public function rewind(): void
    {
        $this->_pos = 0;
    }
    
    public function current()
    {
        return $this->items[$this->_pos];
    }
    
    public function key()
    {
        return $this->_pos;
    }
    
    public function next(): void
    {
        ++$this->_pos;
    }
    
    public function valid(): bool
    {
        return isset($this->items[$this->_pos]);
    }
}
