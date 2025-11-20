<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Application\Service\RelatorioService;

$service = new RelatorioService();
$relatorio = $service->obterRelatorio();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório Estacionamento</title>
</head>
<body>
    <h1>Relatório de Veículos e Faturamento</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Tipo de Veículo</th>
                <th>Total de Veículos</th>
                <th>Faturamento (R$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($relatorio as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['tipo']) ?></td>
                <td><?= $item['total_veiculos'] ?></td>
                <td><?= number_format($item['faturamento'], 2, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
