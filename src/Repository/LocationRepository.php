<?php

namespace App\Repository;

use App\Model\Location;

class LocationRepository
{

    public function findAll(): array
    {
        $location1 = new Location(1, "Alex", 500, "Alexanderplatz 1, 10178 Berlin");
        $location2 = new Location(2, "Berghain", 1350, "Am Wriezener Bahnhof, 10243 Berlin");
        $location3 = new Location(3, "The Street", 10000, "Potsdamer Strasse 2, 10785 Berlin");

        return [$location1, $location2, $location3];
    }

    public function findById(int $id): Location|null
    {
        $locations = $this->findAll();
        foreach ($locations as $location) {
            if ($location->getId() == $id) {
                return $location;
            }
        }
        return null;
    }


}