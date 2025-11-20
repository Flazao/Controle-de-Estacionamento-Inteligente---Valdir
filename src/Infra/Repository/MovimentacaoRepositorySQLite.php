<?php
namespace Infra\Repository;

use Domain\Entity\Veiculo;
use Infra\Database\DatabaseConnection;

class MovimentacaoRepositorySQLite
{
    public function registrarEntrada(Veiculo $veiculo): void
    {
        $db = DatabaseConnection::getInstance();
        $stmt = $db->prepare('INSERT INTO movimentacoes (placa, tipo, data_entrada) VALUES (:placa, :tipo, :data_entrada)');
        $stmt->bindValue(':placa', $veiculo->getPlaca(), SQLITE3_TEXT);
        $stmt->bindValue(':tipo', $veiculo->getTipo(), SQLITE3_TEXT);
        $stmt->bindValue(':data_entrada', date('Y-m-d H:i:s'), SQLITE3_TEXT);
        $stmt->execute();
    }

    public function buscarEntrada(string $placa): ?array
    {
        $db = DatabaseConnection::getInstance();
        $stmt = $db->prepare('SELECT * FROM movimentacoes WHERE placa = :placa AND data_saida IS NULL');
        $stmt->bindValue(':placa', $placa, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
        return $result ?: null;
    }

    public function registrarSaida(Veiculo $veiculo, float $valor): void
    {
        $db = DatabaseConnection::getInstance();
        $stmt = $db->prepare(
            'UPDATE movimentacoes SET data_saida = :data_saida, valor_pago = :valor_pago WHERE placa = :placa AND data_saida IS NULL'
        );
        $stmt->bindValue(':data_saida', date('Y-m-d H:i:s'), SQLITE3_TEXT);
        $stmt->bindValue(':valor_pago', $valor, SQLITE3_FLOAT);
        $stmt->bindValue(':placa', $veiculo->getPlaca(), SQLITE3_TEXT);
        $stmt->execute();
    }
}
