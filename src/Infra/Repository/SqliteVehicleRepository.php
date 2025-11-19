<?php
namespace App\Infra\Repository;

use App\Domain\Entity\Vehicle;
use App\Domain\Repository\VehicleRepositoryInterface;
use PDO;

class SqliteVehicleRepository implements VehicleRepositoryInterface
{
    public function __construct(private PDO $pdo) {}

    public function findByPlate(string $plate): ?Vehicle
    {
        $stmt = $this->pdo->prepare('SELECT * FROM vehicles WHERE plate = :plate');
        $stmt->execute([':plate' => strtoupper($plate)]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Vehicle((int)$row['id'], $row['plate'], $row['type']) : null;
    }

    public function save(Vehicle $vehicle): Vehicle
    {
        $stmt = $this->pdo->prepare('INSERT INTO vehicles (plate, type) VALUES (:plate, :type)');
        $stmt->execute([
            ':plate' => strtoupper($vehicle->getPlate()),
            ':type' => $vehicle->getType()
        ]);
        $id = (int)$this->pdo->lastInsertId();
        return new Vehicle($id, $vehicle->getPlate(), $vehicle->getType());
    }
}
