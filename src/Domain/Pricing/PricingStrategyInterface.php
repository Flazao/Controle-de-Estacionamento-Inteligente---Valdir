<?php
namespace App\Domain\Pricing;

interface PricingStrategyInterface
{
    public function calculate(float $hours): float;
}
