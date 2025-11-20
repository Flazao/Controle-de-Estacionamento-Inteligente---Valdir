<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Domain\Entity\Veiculo;
use Domain\Service\TarifaCarro;
use Infra\Repository\VeiculoRepositorySQLite;
use Infra\Repository\MovimentacaoRepositorySQLite;
use Application\Service\MovimentacaoService;

$placa = $_POST['placa'] ?? '';
$tipo = $_POST['tipo'] ?? '';

if (!$placa || !$tipo) {
    die('Placa e tipo são obrigatórios');
}

$veiculo = new Veiculo($placa, $tipo);
$veiculoRepo = new VeiculoRepositorySQLite();
$movRepo = new MovimentacaoRepositorySQLite();

if (!$veiculoRepo->buscarPorPlaca($placa)) {
    $veiculoRepo->salvar($veiculo);
}

$tarifa = new TarifaCarro();
$service = new MovimentacaoService($tarifa, $movRepo);

$service->registrarEntrada($veiculo);

echo "Entrada registrada para veículo $placa do tipo $tipo.";
