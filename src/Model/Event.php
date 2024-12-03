<?php

namespace App\Model;

class Event
{
    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $location
     * @param int $bookedSeats
     */
    public function __construct(private int    $id,
                                private string $name,
                                private string $description,
                                private string $location,
                                private int    $bookedSeats)
    {

    }


// Getters //
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getBookedSeats(): string
    {
        return $this->bookedSeats;
    }

    public function seats(): int
    {
        return 200 - $this->bookedSeats;
    }


}