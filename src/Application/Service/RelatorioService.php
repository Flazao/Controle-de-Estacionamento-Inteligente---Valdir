<?php
namespace Application\Service;

use Infra\Database\DatabaseConnection;

class RelatorioService
{
    public function obterRelatorio(): array
    {
        $db = DatabaseConnection::getInstance();
        
        $sql = "SELECT tipo, COUNT(*) AS total_veiculos, SUM(valor_pago) AS faturamento
                FROM movimentacoes
                GROUP BY tipo";

        $result = $db->query($sql);

        $relatorio = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $relatorio[] = [
                'tipo' => $row['tipo'],
                'total_veiculos' => (int)$row['total_veiculos'],
                'faturamento' => (float)$row['faturamento']
            ];
        }
        
        return $relatorio;
    }
}
