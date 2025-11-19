<?php
namespace App\Domain\Repository;

use App\Domain\Entity\Vehicle;

interface VehicleRepositoryInterface
{
    public function findByPlate(string $plate): ?Vehicle;
    public function save(Vehicle $vehicle): Vehicle;
}
