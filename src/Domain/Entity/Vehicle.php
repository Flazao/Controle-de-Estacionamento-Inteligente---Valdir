<?php
namespace App\Domain\Entity;

class Vehicle
{
    private ?int $id;
    private string $plate;
    private string $type;

    public function __construct(?int $id, string $plate, string $type)
    {
        $this->id = $id;
        $this->plate = strtoupper($plate);
        $this->type = $type;
    }
    public function getId(): ?int { return $this->id; }
    public function getPlate(): string { return $this->plate; }
    public function getType(): string { return $this->type; }
}
