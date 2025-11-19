<?php
namespace App\Domain\Entity;

class ParkingRecord
{
    private ?int $id;
    private int $vehicleId;
    private \DateTimeImmutable $entryAt;
    private ?\DateTimeImmutable $exitAt;
    private ?float $amount;

    public function __construct(
        ?int $id,
        int $vehicleId,
        \DateTimeImmutable $entryAt,
        ?\DateTimeImmutable $exitAt = null,
        ?float $amount = null
    ) {
        $this->id = $id;
        $this->vehicleId = $vehicleId;
        $this->entryAt = $entryAt;
        $this->exitAt = $exitAt;
        $this->amount = $amount;
    }
    public function getId(): ?int { return $this->id; }
    public function getVehicleId(): int { return $this->vehicleId; }
    public function getEntryAt(): \DateTimeImmutable { return $this->entryAt; }
    public function getExitAt(): ?\DateTimeImmutable { return $this->exitAt; }
    public function getAmount(): ?float { return $this->amount; }
}
