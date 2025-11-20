<?php
namespace Domain\Service;

interface TarifaInterface
{
    public function calcular(int $tempoHoras): float;
}
