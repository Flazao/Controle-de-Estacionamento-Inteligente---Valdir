<?php

namespace Domain\Service;

use Domain\Entity\Vehicle;

class TariffCalculatorService
{
    private array $tariffs = [
        'car'        => 5,
        'motorcycle' => 3,
        'truck'      => 10
    ];

    public function calculate(Vehicle $vehicle): float
    {
        $entry = $vehicle->getEntryTime();
        $exit  = $vehicle->getExitTime();

        if (!$entry || !$exit) {
            throw new \Exception("Entry or exit time not set.");
        }

        $hours = $this->calculateHours($entry, $exit);
        $rate  = $this->tariffs[$vehicle->getType()];

        return $hours * $rate;
    }

    private function calculateHours(\DateTime $entry, \DateTime $exit): int
    {
        $interval = $entry->diff($exit);
        $hours = ($interval->days * 24) + $interval->h;

        if ($interval->i > 0 || $interval->s > 0) {
            $hours++;
        }

        return max(1, $hours);
    }
}
