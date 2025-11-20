<?php
namespace Application\Service;

use Domain\Entity\Veiculo;
use Domain\Service\TarifaInterface;
use Infra\Repository\MovimentacaoRepositorySQLite;

class MovimentacaoService
{
    private TarifaInterface $tarifa;
    private MovimentacaoRepositorySQLite $repository;

    public function __construct(
        TarifaInterface $tarifa,
        MovimentacaoRepositorySQLite $repository
    ) {
        $this->tarifa = $tarifa;
        $this->repository = $repository;
    }

    public function registrarEntrada(Veiculo $veiculo): void
    {
        $this->repository->registrarEntrada($veiculo);
    }

    public function registrarSaida(Veiculo $veiculo): float
    {
        $entrada = $this->repository->buscarEntrada($veiculo->getPlaca());
        if (!$entrada) throw new \Exception("Entrada não localizada");

        $tempoHoras = ceil((time() - strtotime($entrada['data_entrada'])) / 3600);
        $valor = $this->tarifa->calcular($tempoHoras);

        $this->repository->registrarSaida($veiculo, $valor);

        return $valor;
    }
}
