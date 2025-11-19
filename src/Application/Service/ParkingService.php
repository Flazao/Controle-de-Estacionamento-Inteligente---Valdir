<?php
namespace App\Application\Service;

use App\Domain\Repository\VehicleRepositoryInterface;
use App\Domain\Repository\ParkingRepositoryInterface;
use App\Domain\Entity\Vehicle;
use App\Domain\Pricing\PricingStrategyInterface;

class ParkingService
{
    private array $pricingTable; // tipo => PricingStrategyInterface

    public function __construct(
        private VehicleRepositoryInterface $vehicles,
        private ParkingRepositoryInterface $parking,
        array $pricingTable
    ) {
        $this->pricingTable = $pricingTable;
    }

    public function registerEntry(string $plate, string $type): void
    {
        $vehicle = $this->vehicles->findByPlate($plate);
        if (!$vehicle) {
            $vehicle = $this->vehicles->save(new Vehicle(null, $plate, $type));
        }
        $this->parking->open($vehicle->getId(), new \DateTimeImmutable('now'));
    }

    public function registerExit(string $plate): float
    {
        $row = $this->parking->findOpenByPlate($plate);
        if (!$row) {
            throw new \RuntimeException('Nenhuma entrada encontrada para esta placa.');
        }
        $entryAt = new \DateTimeImmutable($row['entry_at']);
        $exitAt = new \DateTimeImmutable('now');
        $type = $row['type'];
        $hours = max(1, (int)ceil(($exitAt->getTimestamp() - $entryAt->getTimestamp()) / 3600));
        $price = $this->pricingTable[$type]->calculate($hours);
        $this->parking->close((int)$row['id'], $exitAt, $price);
        return $price;
    }
}
