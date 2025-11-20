<?php
namespace Domain\Service;

class TarifaCaminhao implements TarifaInterface
{
    private float $valorHora = 10.0;

    public function calcular(int $tempoHoras): float
    {
        return $tempoHoras * $this->valorHora;
    }
}
