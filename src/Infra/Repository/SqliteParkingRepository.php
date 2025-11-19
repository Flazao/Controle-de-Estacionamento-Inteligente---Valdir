<?php
namespace App\Infra\Repository;

use App\Domain\Repository\ParkingRepositoryInterface;
use App\Domain\Entity\ParkingRecord;
use PDO;

class SqliteParkingRepository implements ParkingRepositoryInterface
{
    public function __construct(private PDO $pdo) {}

    public function open(int $vehicleId, \DateTimeImmutable $entryAt): ParkingRecord
    {
        $stmt = $this->pdo->prepare('INSERT INTO parking_records (vehicle_id, entry_at) VALUES (:vehicle_id, :entry_at)');
        $stmt->execute([
            ':vehicle_id' => $vehicleId,
            ':entry_at' => $entryAt->format('c')
        ]);
        $id = (int)$this->pdo->lastInsertId();
        return new ParkingRecord($id, $vehicleId, $entryAt);
    }

    public function findOpenByPlate(string $plate): ?array
    {
        $sql = "SELECT pr.id, pr.entry_at, v.type FROM parking_records pr
                JOIN vehicles v ON v.id = pr.vehicle_id
                WHERE v.plate = :plate AND pr.exit_at IS NULL
                ORDER BY pr.id DESC LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':plate' => strtoupper($plate)]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function close(int $id, \DateTimeImmutable $exitAt, float $amount): void
    {
        $stmt = $this->pdo->prepare('UPDATE parking_records SET exit_at = :exit_at, amount = :amount WHERE id = :id');
        $stmt->execute([
            ':exit_at' => $exitAt->format('c'),
            ':amount' => $amount,
            ':id' => $id,
        ]);
    }

    public function reportTotals(): array
    {
        $sql = "SELECT v.type, COUNT(pr.id) as count, COALESCE(SUM(pr.amount),0) as revenue
                FROM vehicles v
                LEFT JOIN parking_records pr ON pr.vehicle_id = v.id AND pr.amount IS NOT NULL
                GROUP BY v.type";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
