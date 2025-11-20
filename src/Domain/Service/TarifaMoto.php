<?php
namespace Domain\Service;

class TarifaMoto implements TarifaInterface
{
    private float $valorHora = 3.0;

    public function calcular(int $tempoHoras): float
    {
        return $tempoHoras * $this->valorHora;
    }
}

