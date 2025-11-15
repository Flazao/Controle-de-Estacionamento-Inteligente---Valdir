<?php

namespace Application\Service;

use Domain\Service\TariffCalculatorService;

class ExitService
{
    private array $vehicles;
    private TariffCalculatorService $calculator;

    public function __construct(array &$vehicles, TariffCalculatorService $calculator)
    {
        $this->vehicles = &$vehicles;
        $this->calculator = $calculator;
    }

    public function registerExit(string $plate): float
    {
        if (!isset($this->vehicles[$plate])) {
            throw new \Exception("Vehicle not found.");
        }

        $vehicle = $this->vehicles[$plate];
        $vehicle->setExitTime(new \DateTime());

        $price = $this->calculator->calculate($vehicle);

        unset($this->vehicles[$plate]);

        return $price;
    }
}
