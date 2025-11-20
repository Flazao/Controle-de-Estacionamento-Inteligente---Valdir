<?php
namespace Domain\Repository;

use Domain\Entity\Veiculo;

interface VeiculoRepositoryInterface
{
    public function salvar(Veiculo $veiculo): void;
    public function buscarPorPlaca(string $placa): ?Veiculo;
}
