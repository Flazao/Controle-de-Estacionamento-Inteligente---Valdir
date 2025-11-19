<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Infra\Repository\SqliteVehicleRepository;
use App\Infra\Repository\SqliteParkingRepository;
use App\Domain\Pricing\FixedPricingStrategy;
use App\Application\Service\ParkingService;
use App\Application\Service\ReportService;

$pdo = require __DIR__ . '/../src/Infra/Database/connection.php';

$pricingTable = [
    'carro' => new FixedPricingStrategy(5.0),
    'moto' => new FixedPricingStrategy(3.0),
    'caminhao' => new FixedPricingStrategy(10.0)
];
$vehicleRepo = new SqliteVehicleRepository($pdo);
$parkingRepo = new SqliteParkingRepository($pdo);

$parkingSrv = new ParkingService($vehicleRepo, $parkingRepo, $pricingTable);
$reportSrv = new ReportService($parkingRepo);

$page = $_GET['p'] ?? 'entrada';
if ($page === 'entrada') { include 'entrada.php'; }
elseif ($page === 'saida') { include 'saida.php'; }
elseif ($page === 'relatorio') { include 'relatorio.php'; }
else { echo 'Página não encontrada.'; }
