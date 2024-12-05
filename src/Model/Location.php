<?php

namespace App\Model;

class Location
{

    /**
     * @param int $id
     * @param string $name
     * @param int $capacity
     * @param string $address
     */
    public function __construct(private int    $id,
                                private string $name,
                                private int    $capacity,
                                private string $address)
    {

    }


    /// Getter ///
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getAddress(): string
    {
        return $this->address;
    }





}



