<?php
namespace Domain\Service;

class TarifaCarro implements TarifaInterface
{
    private float $valorHora = 5.0;

    public function calcular(int $tempoHoras): float
    {
        return $tempoHoras * $this->valorHora;
    }
}
