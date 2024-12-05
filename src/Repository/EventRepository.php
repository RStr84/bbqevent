<?php

namespace App\Repository;

use App\Model\Event;

class EventRepository
{
    public function findAll(): array
    {
        $event1 = new Event(1, "Techno", "super Techno Event", "Alex", 50);
        $event2 = new Event(2, "Rock", "super Rock Event", "Berghain", 190);
        $event3 = new Event(3, "Hip Hop", "super Hip Hop Event", "The Street", 200);

        return [$event1, $event2, $event3];
    }

    public function findById(int $id): Event|null
    {
       $events = $this->findAll();
       foreach ($events as $event) {
           if ($event->getId() == $id) {
               return $event;
           }
       }
       return null;
    }
}