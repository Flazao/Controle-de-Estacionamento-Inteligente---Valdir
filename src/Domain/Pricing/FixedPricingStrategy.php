<?php
namespace App\Domain\Pricing;

class FixedPricingStrategy implements PricingStrategyInterface
{
    private float $pricePerHour;

    public function __construct(float $pricePerHour)
    {
        $this->pricePerHour = $pricePerHour;
    }
    public function calculate(float $hours): float
    {
        return $this->pricePerHour * $hours;
    }
}
