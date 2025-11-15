<?php

namespace Application\DTO;

use Domain\Entity\Car;
use Domain\Entity\Motorcycle;
use Domain\Entity\Truck;

class VehicleDTO
{
    public function __construct(
        private string $plate,
        private string $type
    ) {}

    public function createVehicle()
    {
        return match ($this->type) {
            'car' => new Car($this->plate),
            'motorcycle' => new Motorcycle($this->plate),
            'truck' => new Truck($this->plate),
            default => throw new \Exception("Invalid vehicle type.")
        };
    }
}
