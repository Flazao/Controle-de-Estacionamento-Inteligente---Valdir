<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Domain\Entity\Veiculo;
use Domain\Service\TarifaCarro;
use Domain\Service\TarifaMoto;
use Domain\Service\TarifaCaminhao;
use Infra\Repository\MovimentacaoRepositorySQLite;

$placa = $_POST['placa'] ?? '';

if (!$placa) {
    die('Placa é obrigatória');
}

$movRepo = new MovimentacaoRepositorySQLite();

$entrada = $movRepo->buscarEntrada($placa);
if (!$entrada) {
    die("Nenhuma entrada ativa encontrada para a placa $placa");
}

$veiculo = new Veiculo($entrada['placa'], $entrada['tipo']);

switch ($veiculo->getTipo()) {
    case 'carro':
        $tarifa = new TarifaCarro();
        break;
    case 'moto':
        $tarifa = new TarifaMoto();
        break;
    case 'caminhao':
        $tarifa = new TarifaCaminhao();
        break;
    default:
        die('Tipo de veículo inválido');
}

$service = new Application\Service\MovimentacaoService($tarifa, $movRepo);
$valor = $service->registrarSaida($veiculo);

echo "Saída registrada para $placa. Total a pagar: R$ $valor";
