<?php

namespace Domain\Entity;

abstract class Vehicle
{
    protected string $plate;
    protected string $type;
    protected ?\DateTime $entryTime = null;
    protected ?\DateTime $exitTime = null;

    public function __construct(string $plate, string $type)
    {
        $this->plate = $plate;
        $this->type  = $type;
    }

    public function getPlate(): string
    {
        return $this->plate;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setEntryTime(\DateTime $time): void
    {
        $this->entryTime = $time;
    }

    public function setExitTime(\DateTime $time): void
    {
        $this->exitTime = $time;
    }

    public function getEntryTime(): ?\DateTime
    {
        return $this->entryTime;
    }

    public function getExitTime(): ?\DateTime
    {
        return $this->exitTime;
    }
}
