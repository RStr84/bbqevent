<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\EventTypeEnum;
use App\Entity\Location;
use App\Factory\EventFactory;
use App\Factory\LocationFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1-2 Datensätze für besondere Rechte → Admin/User //

        // Event //
        $event = new Event();
        $event->setName('Event 1');
        $event->setEventType(EventTypeEnum::Party);
        $event->setDescription('Description 1');
        $event->setBookedSeats(150);

        // Datensatz Faker //
        EventFactory::createMany(100);

        // Location //
        $location = new Location();
        $location->setName('Location 1');
        $location->setCapacity(1000);
        $location->setAddress('Address 1');
        $location->setEmail('email@email.com');

        // Datensatz Faker //
        LocationFactory::createMany(100);

        // Erstellen und Datenbank hinzufügen //
        $manager->persist($event);
        $manager->persist($location);
        $manager->flush();
    }
}
