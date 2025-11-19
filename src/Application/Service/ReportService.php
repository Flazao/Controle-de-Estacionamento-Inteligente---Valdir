<?php
namespace App\Application\Service;

use App\Domain\Repository\ParkingRepositoryInterface;

class ReportService
{
    public function __construct(private ParkingRepositoryInterface $parking) {}

    public function totalsByType(): array
    {
        return $this->parking->reportTotals();
    }
}
