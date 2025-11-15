<?php

require __DIR__ . '/vendor/autoload.php';

use Application\DTO\VehicleDTO;
use Application\Service\EntryService;
use Application\Service\ExitService;
use Application\Service\ReportService;
use Domain\Service\TariffCalculatorService;

$vehicles = [];
$history  = [];

$entryService  = new EntryService($vehicles);
$calculator    = new TariffCalculatorService();
$exitService   = new ExitService($vehicles, $calculator);
$reportService = new ReportService($history);

echo "Iniciando sistema de estacionamento inteligente\n";

try {
    $dto1 = new VehicleDTO('AAA-0001', 'car');
    $v1 = $entryService->registerEntry($dto1);

    $dto2 = new VehicleDTO('BBB-0002', 'motorcycle');
    $v2 = $entryService->registerEntry($dto2);

    $dto3 = new VehicleDTO('CCC-0003', 'truck');
    $v3 = $entryService->registerEntry($dto3);

    echo "Entradas registradas:\n";
    foreach ([$v1, $v2, $v3] as $v) {
        echo "- {$v->getPlate()} ({$v->getType()}) entrada em {$v->getEntryTime()->format('d-m-Y H:i:s')}\n";
    }

    $v1->setEntryTime((new \DateTime())->modify('-1 hora')->modify('-10 minutos'));
    $v2->setEntryTime((new \DateTime())->modify('-30 minutos'));
    $v3->setEntryTime((new \DateTime())->modify('-3 horas')->modify('-5 minutos'));

    $vehiclesToExit = [$v1, $v2, $v3];

    foreach ($vehiclesToExit as $veh) {
        $plate = $veh->getPlate();
        $type  = $veh->getType();
        $amount = $exitService->registerExit($plate);
        $history[] = [
            'placa'  => $plate,
            'tipo'   => $type,
            'Tarifa' => $amount
        ];
        echo "\nSaída: {$plate} ({$type}) => Quantia: R$ {$amount}\n";
    }

    $report = $reportService->generate();

    echo "\nRelatorio\n";
    foreach ($report as $type => $data) {
        echo strtoupper($type) . ": {$data['count']} veiculo(s) - R$ {$data['total']}\n";
    }
    echo "--------------\n";

    echo "Contagem de veículos: " . count($vehicles) . "\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
