<?php

namespace Domain\Entity;

class Motorcycle extends Vehicle
{
    public function __construct(string $plate)
    {
        parent::__construct($plate, 'motorcycle');
    }
}
