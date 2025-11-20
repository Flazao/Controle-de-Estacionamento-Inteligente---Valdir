<?php
namespace Infra\Repository;

use Domain\Entity\Veiculo;
use Domain\Repository\VeiculoRepositoryInterface;
use Infra\Database\DatabaseConnection;

class VeiculoRepositorySQLite implements VeiculoRepositoryInterface
{
    public function salvar(Veiculo $veiculo): void
    {
        $db = DatabaseConnection::getInstance();
        $stmt = $db->prepare('INSERT INTO veiculos (placa, tipo) VALUES (:placa, :tipo)');
        $stmt->bindValue(':placa', $veiculo->getPlaca(), SQLITE3_TEXT);
        $stmt->bindValue(':tipo', $veiculo->getTipo(), SQLITE3_TEXT);
        $stmt->execute();
    }

    public function buscarPorPlaca(string $placa): ?Veiculo
    {
        $db = DatabaseConnection::getInstance();
        $stmt = $db->prepare('SELECT * FROM veiculos WHERE placa = :placa');
        $stmt->bindValue(':placa', $placa, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
        if (!$result) return null;
        return new Veiculo($result['placa'], $result['tipo']);
    }
}
