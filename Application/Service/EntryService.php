<?php

namespace Application\Service;

use Application\DTO\VehicleDTO;
use Domain\Entity\Vehicle;

class EntryService
{
    private array $vehicles;

    public function __construct(array &$vehicles)
    {
        $this->vehicles = &$vehicles;
    }

    public function registerEntry(VehicleDTO $dto): Vehicle
    {
        $vehicle = $dto->createVehicle();
        $vehicle->setEntryTime(new \DateTime());

        $this->vehicles[$vehicle->getPlate()] = $vehicle;

        return $vehicle;
    }
}
