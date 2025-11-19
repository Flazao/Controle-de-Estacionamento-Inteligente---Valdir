<?php
namespace App\Domain\Repository;

use App\Domain\Entity\ParkingRecord;

interface ParkingRepositoryInterface
{
    public function open(int $vehicleId, \DateTimeImmutable $entryAt): ParkingRecord;
    public function findOpenByPlate(string $plate): ?array;
    public function close(int $id, \DateTimeImmutable $exitAt, float $amount): void;
    public function reportTotals(): array;
}
